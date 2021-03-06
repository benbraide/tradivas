@extends('layouts.master')

@section('title', "Administration")

@php

$colors = App\Color::all();
$sizes = App\Size::all();
$categories = App\Category::all();
$themes = App\Theme::all();
$settings = App\Setting::first();

if (!$settings){
    $settings = new App\Setting;
    $settings->theme_id = 1;
    $settings->images_base = "http://image.tradivas.com/";
    $settings->default_path = str_random(30);
    $settings->default_image = (str_random(30) . ".png");
    $settings->logo = (str_random(30) . ".png");
}

@endphp

@section('colors')
    <select name="colors[]" multiple="multiple" class="tradivas-select tradivas-colors">
        @foreach ($colors as $color)
            <option value="{{ $color->value }}">{{ ' ' . ucwords($color->name) }}</option>
        @endforeach
    </select>
@endsection

@section('sizes')
    <select name="sizes[]" multiple="multiple" class="tradivas-select">
        @foreach ($sizes as $size)
            <option value="{{ $size->id }}">{{ ' ' . $size->value }}</option>
        @endforeach
    </select>
@endsection

@section('categories')
    <select name="category" class="form-control tradivas-category" required>
        <option value="" selected disabled hidden>Select One</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
@endsection

@section('themes')
    <select name="theme_id" class="form-control">
        @foreach ($themes as $theme)
            @if ($theme->id == $settings->theme_id)
                <option value="{{ $theme->id }}" selected="selected">{{ ucwords($theme->name) }}</option>
            @else
                <option value="{{ $theme->id }}">{{ ucwords($theme->name) }}</option>
            @endif
        @endforeach
    </select>
@endsection

@section('theme-links')
    @foreach ($themes as $theme)
        <div class="tradivas-theme-link">
            <a href="/themes/{{ $theme->id }}" class="tradivas-theme-anchor">
                {{ ucwords($theme->name) }}
                <div style="background: linear-gradient(to bottom, {{ $theme->bg_color_start }}, {{ $theme->bg_color_stop }} 120%) no-repeat;"></div>
            </a>
            <a href="/themes/{{ $theme->id }}/delete" class="tradivas-theme-link-anchor" title="Delete theme">
                <span class="oi oi-x" aria-hidden="true"></span>
            </a>
        </div>
    @endforeach
    <div class="tradivas-theme-link">
        <a href="/themes/0">Create New <span class="oi oi-plus" aria-hidden="true"></span></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid tradivas-admin">
        <div class="row">
            <div class="col-5 tradivas-user-text">
                <h2>Add Meta Values</h2>
                <form method="POST" action="/cat/create" class="tradivas-user-form">
                    @csrf
                    <div class="form-group row">
                        <label for="cat_name" class="col-3 col-form-label">Category</label>
                        <div class="col-9">
                            <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Category Name" required>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Add Category</button>
                    </div>
                </form>
                <div class="tradivas-ruler"></div>
                @if ($categories->isNotEmpty())
                    <form method="POST" action="/subcat/create" class="tradivas-user-form">
                        @csrf
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Category</label>
                            <div class="col-9">
                                @yield('categories')
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sub_cat_name" class="col-3 col-form-label">Sub Category</label>
                            <div class="col-9">
                                <input type="text" id="sub_cat_name" name="sub_cat_name" class="form-control" placeholder="Sub Category Name" required>
                            </div>
                        </div>
                        <div class="col-9 offset-3 submit">
                            <button type="submit" class="btn login-btn tradivas-btn">Add Sub Category</button>
                        </div>
                    </form>
                    <div class="tradivas-ruler"></div>
                @endif
                <form method="POST" action="/sizes/create" class="tradivas-user-form">
                    @csrf
                    <div class="form-group row">
                        <label for="sizes" class="col-3 col-form-label">Add Sizes</label>
                        <div class="col-9">
                            <input type="text" id="sizes" name="sizes" class="form-control" placeholder="Sizes" required>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Add Sizes</button>
                    </div>
                </form>
                <div class="tradivas-ruler"></div>
                <form method="POST" action="/colors/create" class="tradivas-user-form">
                    @csrf
                    <div class="form-group row">
                        <label for="color_name" class="col-3 col-form-label">Color Name</label>
                        <div class="col-9">
                            <input type="text" id="color_name" name="color_name" class="form-control" placeholder="Color Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_value" class="col-3 col-form-label">Color Value</label>
                        <div class="col-9">
                            <input type="color" id="color_value" name="color_value" class="form-control" placeholder="Color Value" required>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Add Color</button>
                    </div>
                </form>
                <div class="tradivas-ruler"></div>
                <form method="POST" action="/settings/update" class="tradivas-user-form">
                    @csrf
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Theme</label>
                        <div class="col-9">
                            @yield('themes')
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="images_base" class="col-3 col-form-label">Images Base</label>
                        <div class="col-9">
                            <input type="text" id="images_base" name="images_base" class="form-control" value="{{ $settings->images_base }}" placeholder="Images Base" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="default_path" class="col-3 col-form-label">Def Path</label>
                        <div class="col-9">
                            <input type="text" id="default_path" name="default_path" class="form-control" value="{{ $settings->default_path }}" placeholder="Default Path" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="default_image" class="col-3 col-form-label">Def Image</label>
                        <div class="col-9">
                            <input type="text" id="default_image" name="default_image" class="form-control" value="{{ $settings->default_image }}" placeholder="Default Image" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="logo" class="col-3 col-form-label">Logo Image</label>
                        <div class="col-9">
                            <input type="text" id="logo" name="logo" class="form-control" value="{{ $settings->logo }}" placeholder="Logo Image" required>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Update Settings</button>
                    </div>
                </form>
            </div>
            <div class="col-7">
                <h2>Add New Item</h2>
                <form method="POST" action="/items/create" enctype="multipart/form-data" class="tradivas-user-form">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-3 col-form-label">Title</label>
                        <div class="col-9">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <textarea id="description" name="description" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-3 col-form-label">Price</label>
                        <div class="col-9">
                            <input type="text" id="price" name="price" class="form-control" placeholder="Price" required>
                        </div>
                    </div>
                    @if ($colors->isNotEmpty())
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Colors</label>
                            <div class="col-9">
                                @yield('colors')
                            </div>
                        </div>
                    @endif
                    @if ($sizes->isNotEmpty())
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Sizes</label>
                            <div class="col-9">
                                @yield('sizes')
                            </div>
                        </div>
                    @endif
                    @if ($categories->isNotEmpty())
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Category</label>
                            <div class="col-9 tradivas-get-sub-categories">
                                @yield('categories')
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Sub Category</label>
                            <div class="col-9">
                                <select id="sub_category" name="sub_category" class="form-control">
                                    <option value="0" selected disabled hidden>Choose Category</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Cover</label>
                        <div class="col-9">
                            <input type="file" name="cover" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Images</label>
                        <div class="col-9">
                            <input type="file" name="images[]" class="form-control" multiple="multiple">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-3 col-form-label">Stock</label>
                        <div class="col-9">
                            <input type="number" id="stock" name="stock" class="form-control" value="1" min="1" placeholder="Stock" required>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Add Item</button>
                    </div>
                </form>
                <div class="tradivas-ruler"></div>
                <div class="container-fluid tradivas-themes-top">
                    <div class="row">
                        <label class="col-3">Themes</label>
                        <div class="col-9">
                            <div class="tradivas-themes">
                                @yield('theme-links')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-9 offset-3">
                            <a href="/admin/categories" class="btn tradivas-btn">Edit Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        input[type=color].form-control{
            padding: 0px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <script>
        $(function(){
            $("select.tradivas-select").multipleSelect({
                filter: true,
                position: 'top',
                placeholder: "Select all applicable",
            });
            
            $(".tradivas-admin .tradivas-colors li > label").each(function(){
                if (!$(this).parent().hasClass("ms-select-all"))
                    $(this).append('<div style="background-color: ' + $(this).children().eq(0).attr("value") + ';"></div>');
            });

            $(".tradivas-get-sub-categories > select.tradivas-category").change(function(){
                $.get({
                    url: ("api/cat/" + $(this).val()),
                    success: function(data){
                        var sub_category = $("select#sub_category");
                        sub_category.empty();
                        sub_category.append('<option value="0" selected disabled hidden>Select One</option>');
                        $.each(data, function(index, item){
                            sub_category.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
