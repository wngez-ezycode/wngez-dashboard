<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_screen_sections', function (Blueprint $table) {
            $table->json('content')->nullable()->after('sequence');
        });
    }

    public function down(): void
    {
        Schema::table('home_screen_sections', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
};
