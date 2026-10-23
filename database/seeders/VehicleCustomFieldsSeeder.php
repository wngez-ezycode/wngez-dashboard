<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CustomField;
use App\Models\CustomFieldCategory;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Seeds the default specification fields for vehicle categories.
 *
 * The web and mobile clients never hardcode specifications: they render whatever
 * the API returns for the item's category (get-custom-fields, and
 * item.all_translated_custom_fields built from item_custom_field_values).
 * This seeder only creates the field definitions + Arabic translations; the
 * values are filled per ad by the seller.
 *
 * Safe to run repeatedly: fields are matched by name + type and updated.
 */
class VehicleCustomFieldsSeeder extends Seeder
{
    /**
     * Whole-word English matches: a plain `%car%` LIKE also hits "Careers".
     * Arabic has no word boundaries, so prefixes are matched literally.
     */
    private const ENGLISH_PATTERN = '/\b(cars?|vehicles?|automobiles?|motorcycles?|trucks?)\b/iu';

    private const ARABIC_NEEDLES = ['سيار', 'مركب', 'شاحن'];

    public function run(): void
    {
        $categoryIds = $this->vehicleTopLevelCategoryIds();

        if ($categoryIds === []) {
            $this->command?->warn('No vehicle category found (looked for names/slugs like "car", "vehicle", "سيار"). Nothing seeded.');

            return;
        }

        $arabicLanguageId = Language::where('code', 'ar')->value('id');
        $iconPath = $this->ensureDefaultIcon();

        $fields = [
            ['name' => 'Year', 'ar' => 'سنة الصنع', 'type' => 'number', 'min_length' => 1950, 'max_length' => (int) date('Y')],
            ['name' => 'Brand', 'ar' => 'الماركة', 'type' => 'textbox', 'min_length' => 1, 'max_length' => 100],
            ['name' => 'Model', 'ar' => 'الموديل', 'type' => 'textbox', 'min_length' => 1, 'max_length' => 100],
            [
                'name' => 'Transmission',
                'ar' => 'ناقل الحركة',
                'type' => 'dropdown',
                'values' => ['Automatic', 'Manual'],
                'ar_values' => ['أوتوماتيك', 'مانيوال'],
            ],
            [
                'name' => 'Fuel Type',
                'ar' => 'نوع الوقود',
                'type' => 'dropdown',
                'values' => ['Petrol', 'Diesel', 'Hybrid', 'Electric'],
                'ar_values' => ['بنزين', 'ديزل', 'هجين', 'كهربائي'],
            ],
            ['name' => 'Color', 'ar' => 'اللون', 'type' => 'textbox', 'min_length' => 1, 'max_length' => 50],
            ['name' => 'Mileage', 'ar' => 'المسافة المقطوعة', 'type' => 'number', 'min_length' => 0, 'max_length' => 2000000],
            [
                'name' => 'Condition',
                'ar' => 'الحالة',
                'type' => 'dropdown',
                'values' => ['New', 'Used'],
                'ar_values' => ['جديد', 'مستعمل'],
            ],
        ];

        foreach ($fields as $field) {
            $attributes = [
                'type' => $field['type'],
                'image' => $iconPath,
                'required' => 0,
                'status' => 1,
                'min_length' => $field['min_length'] ?? null,
                'max_length' => $field['max_length'] ?? null,
                'values' => isset($field['values']) ? json_encode($field['values'], JSON_THROW_ON_ERROR) : null,
            ];

            $customField = CustomField::query()
                ->where('name', $field['name'])
                ->where('type', $field['type'])
                ->first();

            if ($customField) {
                $customField->fill($attributes)->save();
            } else {
                $customField = CustomField::create(['name' => $field['name']] + $attributes);
            }

            foreach ($categoryIds as $categoryId) {
                CustomFieldCategory::firstOrCreate([
                    'custom_field_id' => $customField->id,
                    'category_id' => $categoryId,
                ]);
            }

            // Drop links left over from an earlier run that no longer qualify
            // (e.g. the `%car%` LIKE that used to match "Jobs & Careers").
            CustomFieldCategory::query()
                ->where('custom_field_id', $customField->id)
                ->whereNotIn('category_id', $categoryIds)
                ->delete();

            if ($arabicLanguageId) {
                $this->storeTranslation($customField, (int) $arabicLanguageId, 'name', $field['ar']);

                if (isset($field['ar_values'])) {
                    $this->storeTranslation(
                        $customField,
                        (int) $arabicLanguageId,
                        'value',
                        json_encode($field['ar_values'], JSON_THROW_ON_ERROR)
                    );
                }
            }
        }

        $this->command?->info(sprintf(
            'Seeded %d vehicle specification fields for categories: %s',
            count($fields),
            implode(', ', $categoryIds)
        ));
    }

    /**
     * All top-level categories that contain a vehicle keyword, in the category
     * name/slug or in its Arabic translation.
     *
     * @return array<int, int>
     */
    private function vehicleTopLevelCategoryIds(): array
    {
        $candidateIds = [];

        foreach (Category::all(['id', 'name', 'parent_category_id']) as $category) {
            if ($this->matchesVehicleKeyword($category->name)) {
                $candidateIds[$category->id] = true;
            }
        }

        $translatedNames = Translation::query()
            ->where('translatable_type', Category::class)
            ->where('key', 'name')
            ->get(['translatable_id', 'value']);

        foreach ($translatedNames as $translation) {
            if ($this->matchesVehicleKeyword($translation->value)) {
                $candidateIds[$translation->translatable_id] = true;
            }
        }

        $rootIds = [];

        foreach (array_keys($candidateIds) as $categoryId) {
            $category = Category::find($categoryId, ['id', 'parent_category_id']);

            if (! $category) {
                continue;
            }

            $guard = 0;

            while ($category->parent_category_id && $guard++ < 10) {
                $parent = Category::find($category->parent_category_id, ['id', 'parent_category_id']);

                if (! $parent) {
                    break;
                }

                $category = $parent;
            }

            $rootIds[] = (int) $category->id;
        }

        sort($rootIds);

        return array_values(array_unique($rootIds));
    }

    private function matchesVehicleKeyword(?string $value): bool
    {
        if (! is_string($value) || $value === '') {
            return false;
        }

        if (preg_match(self::ENGLISH_PATTERN, $value) === 1) {
            return true;
        }

        foreach (self::ARABIC_NEEDLES as $needle) {
            if (str_contains($value, $needle)) {
                return true;
            }
        }

        return false;
    }

    private function storeTranslation(CustomField $customField, int $languageId, string $key, string $value): void
    {
        Translation::updateOrCreate(
            [
                'translatable_id' => $customField->id,
                'translatable_type' => get_class($customField),
                'key' => $key,
                'language_id' => $languageId,
            ],
            ['value' => $value]
        );
    }

    /**
     * `custom_fields.image` is NOT NULL, so every field needs an icon. Write one
     * generic svg once instead of shipping per-field artwork.
     */
    private function ensureDefaultIcon(): string
    {
        $path = 'custom-fields/default-spec.svg';

        try {
            if (! Storage::disk(config('filesystems.default'))->exists($path)) {
                Storage::disk(config('filesystems.default'))->put(
                    $path,
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0878F9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 16V9l2-5h10l2 5v7"/><path d="M5 16h14"/><circle cx="7.5" cy="18" r="1.5"/><circle cx="16.5" cy="18" r="1.5"/></svg>'
                );
            }

            return $path;
        } catch (\Throwable $th) {
            return '';
        }
    }
}
