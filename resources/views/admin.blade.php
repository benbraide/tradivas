@extends('layouts.master')

@section('title', "Administration")

@php

$colors = App\Color::all();
$sizes = App\Size::all();
$themes = App\Theme::all();
$settings = App\Setting::first();

@endphp

@section('colors')
    <select multiple="multiple" class="tradivas-select tradivas-colors">
        @foreach ($colors as $color)
            <option value="{{ $color->value }}">{{ ' ' . ucwords($color->name) }}</option>
        @endforeach
    </select>
@endsection

@section('sizes')
    <select multiple="multiple" class="tradivas-select">
        @foreach ($sizes as $size)
            <option value="{{ $size->id }}">{{ ' ' . $size->value }}</option>
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
            <a href="/themes/{{ $theme->id }}/update">
                {{ ucwords($theme->name) }}
                <div style="background-color: {{ "#" . $theme->bg_color_start }};"></div>
            </a>
        </div>
    @endforeach
@endsection

@section('content')
    <div class="container-fluid tradivas-admin">
        <div class="row">
            <div class="col-5 tradivas-user-text">
                <h2>Add Meta Values</h2>
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
                            <input type="text" id="color_value" name="color_value" class="form-control" placeholder="Color Value" required>
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
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Update Settings</button>
                    </div>
                    <div class="tradivas-ruler"></div>
                </form>
                <div class="container-fluid tradivas-themes-top">
                    <div class="row">
                        <label class="col-3">Themes</label>
                        <div class="col-9 tradivas-themes">
                            @yield('theme-links')
                        </div>
                    </div>
                </div>
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
                    <div class="form-group row">
                        <label for="images" class="col-3 col-form-label">Images</label>
                        <div class="col-9">
                            <input type="file" id="images" name="images" class="form-control" multiple="multiple">
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <script>
        $("select.tradivas-select").multipleSelect({
            filter: true,
            position: 'top',
            placeholder: "Select all applicable",
        });
        
        $(".tradivas-admin .tradivas-colors li > label").each(function(){
            if (!$(this).parent().hasClass("ms-select-all"))
                $(this).append('<div style="background-color: ' + $(this).children().eq(0).attr("value") + ';"></div>');
        });
    </script>
@endpush