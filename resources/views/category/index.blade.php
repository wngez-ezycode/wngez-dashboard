@extends('layouts.main')
@section('title')
    {{__("Categories")}}
@endsection

@section('page-title')
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                @if (!empty($category))
                    <a class="btn btn-primary me-2" href="{{ route('category.index') }}">< {{__("Back to All Categories")}} </a>
                    @can('category-create')
                        <a class="btn btn-primary me-2" href="{{ route('category.create', ['id' => $category->id]) }}">+ {{__("Add Subcategory")}} - /{{ $category->name }} </a>
                    @endcanany
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="wngez-list-card-head">
                            <div class="wngez-list-title">
                                <span><i class="ph ph-sliders-horizontal"></i></span>
                                <div>
                                    <h2>{{ __('Set Order of Categories') }}</h2>
                                    <p>{{ __('Drag and drop to change the order of categories.') }}</p>
                                </div>
                            </div>
                            <div class="wngez-list-actions">
                                @can('category-create')
                                    <a class="btn btn-primary" href="{{ route('category.create') }}"><i class="ph ph-plus"></i>{{ __('Add Category') }}</a>
                                    <a href="{{ route('category.bulk-upload') }}" class="btn btn-success"><i class="ph ph-upload-simple"></i>{{ __('Bulk Upload') }}</a>
                                @endcan
                                @can('category-update')
                                    <a href="{{ route('category.bulk-update') }}" class="btn btn-warning"><i class="ph ph-note-pencil"></i>{{ __('Bulk Update') }}</a>
                                @endcan
                            </div>
                        </div>
                        @php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true,'formatter'=>'categoryNameFormatter'],
                                ['field'=>'image','title'=>__('Image'),'align'=>'center','formatter'=>'imageFormatter'],
                                ['field'=>'subcategories_count','title'=>__('Subcategories'),'align'=>'center','sortable'=>false],
                                ['field'=>'custom_fields_count','title'=>__('Custom Fields'),'align'=>'center','sortable'=>false],
                                ['field'=>'advertisements_count','title'=>__('Advertisement Count'),'align'=>'center','sortable'=>true],
                            ];
                            if(auth()->user()->can('category-update')) {
                                $cols[] = ['field'=>'status','title'=>__('Active'),'width'=>5,'sortable'=>true,'formatter'=>'statusSwitchFormatter'];
                            }
                            if(auth()->user()->canany(['category-update','category-delete'])) {
                                $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false];
                            }
                        @endphp
                        <x-data-table
                            id="table_list"
                            :url="route('category.show', $category->id ?? 0)"
                            click-to-select
                            sort-name="sequence"
                            sort-order="asc"
                            table-name="categories"
                            :mobile-responsive="false"
                            show-export
                            export-file-name="category-list"
                            :extra="['data-search-align'=>'right','data-query-params'=>'queryParams','data-use-row-attr-func'=>'true']"
                            :columns="$cols"
                        />

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
