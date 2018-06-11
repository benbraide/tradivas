@extends('layouts.master')

@if ($page_theme_id == 0)
    @section('title', "Create New Theme")
@else
    @section('title', "Theme Preview")
@endif

@section('rule_styles')
    <?php
        $styles = array('solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset', 'initial');
        if ($page_theme_id == 0)
            $theme = null;
        else
            $theme = App\Theme::find($page_theme_id);
    ?>
    <select name="rule_style" class="form-control">
        @foreach ($styles as $style)
            @if (($page_theme_id == 0 && $style == "solid") || ($page_theme_id != 0 && $theme->bg_rule_style == $style))
                <option value="{{ $style }}" selected="selected">{{ ucfirst($style) }}</option>
            @else
                <option value="{{ $style }}">{{ ucfirst($style) }}</option>
            @endif
        @endforeach
    </select>
@endsection

@section('units')
    <?php $units = array('px', 'em', 'rem', '%'); ?>
    <select name="unit" class="form-control">
        @foreach ($units as $unit)
            @if ($unit == "px")
                <option value="{{ $unit }}" selected="selected">{{ $unit }}</option>
            @else
                <option value="{{ $unit }}">{{ $unit }}</option>
            @endif
        @endforeach
    </select>
@endsection

@section('content')
    <form method="POST" action="/themes/{{ ($page_theme_id == 0) ? 0 : $theme->id }}/update" class="tradivas-user-form">
        @csrf
        <div class="container-fluid tradivas-theme-container">
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label">Name</label>
                        <div class="col-9">
                            @if ($page_theme_id == 0)
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                            @else
                                <input type="text" id="name" name="name" class="form-control" value="{{ ucwords($theme->name) }}" placeholder="Name" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_start" class="col-3 col-form-label">Start Color</label>
                        <div class="col-9" title="Header Start Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="color_start" name="color_start" class="form-control" placeholder="Header Start Color" required>
                            @else
                                <input type="text" id="color_start" name="color_start" value="{{ $theme->bg_color_start }}" class="form-control" placeholder="Header Start Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->bg_color_start }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="color_end" class="col-3 col-form-label">End Color</label>
                        <div class="col-9" title="Header End Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="color_end" name="color_end" class="form-control" placeholder="Header End Color" required>
                            @else
                                <input type="text" id="color_end" name="color_end" value="{{ $theme->bg_color_stop }}" class="form-control" placeholder="Header End Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->bg_color_stop }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="color_proportion" class="col-3 col-form-label">Proportion</label>
                        <div class="col-9" title="Header Color Proportion" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="color_proportion" name="color_proportion" value="72" class="form-control" placeholder="Header Color Proportion" required>
                            @else
                                <input type="text" id="color_proportion" name="color_proportion" value="{{ intval($theme->bg_color_start_proportion) }}" class="form-control" placeholder="Header Color Proportion" required>
                            @endif
                            @yield('units')
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rule_color" class="col-3 col-form-label">Rule Color</label>
                        <div class="col-9" title="Rule Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="rule_color" name="rule_color" class="form-control" placeholder="Rule Color" required>
                            @else
                                <input type="text" id="rule_color" name="rule_color" value="{{ $theme->bg_rule_color }}" class="form-control" placeholder="Rule Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->bg_rule_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="rule_width" class="col-3 col-form-label">Rule Width</label>
                        <div class="col-9" title="Rule Width" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="rule_width" name="rule_width" value="1" class="form-control" placeholder="Rule Width" required>
                            @else
                                <input type="text" id="rule_width" name="rule_width" value="{{ intval($theme->bg_rule_width) }}" class="form-control" placeholder="Rule Width" required>
                            @endif
                            @yield('units')
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Rule Style</label>
                        <div class="col-9">
                            @yield('rule_styles')
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="btn_bg_color" class="col-3 col-form-label">Btn Bg Color</label>
                        <div class="col-9" title="Button Background Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="btn_bg_color" name="btn_bg_color" class="form-control" placeholder="Button Background Color" required>
                            @else
                                <input type="text" id="btn_bg_color" name="btn_bg_color" value="{{ $theme->btn_bg_color }}" class="form-control" placeholder="Button Background Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->btn_bg_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="btn_bgh_color" class="col-3 col-form-label">Btn Bgh Color</label>
                        <div class="col-9" title="Button Background Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="btn_bgh_color" name="btn_bgh_color" class="form-control" placeholder="Button Background Highlight Color" required>
                            @else
                                <input type="text" id="btn_bgh_color" name="btn_bgh_color" value="{{ $theme->btn_bg_hilite_color }}" class="form-control" placeholder="Button Background Highlight Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->btn_bg_hilite_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="btn_color" class="col-3 col-form-label">Button Color</label>
                        <div class="col-9" title="Button Text Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="btn_color" name="btn_color" class="form-control" placeholder="Button Color" required>
                            @else
                                <input type="text" id="btn_color" name="btn_color" value="{{ $theme->btn_color }}" class="form-control" placeholder="Button Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->btn_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="btn_h_color" class="col-3 col-form-label">Button H Color</label>
                        <div class="col-9" title="Button Text Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="btn_h_color" name="btn_h_color" class="form-control" placeholder="Button Highlight Color" required>
                            @else
                                <input type="text" id="btn_h_color" name="btn_h_color" value="{{ $theme->btn_hilite_color }}" class="form-control" placeholder="Button Highlight Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->btn_hilite_color }};"></div>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="outline_color" class="col-3 col-form-label">Outline Color</label>
                        <div class="col-9" title="Input Outline Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="outline_color" name="outline_color" class="form-control" placeholder="Input Outline Color" required>
                            @else
                                <input type="text" id="outline_color" name="outline_color" value="{{ $theme->input_outline_color }}" class="form-control" placeholder="Input Outline Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->input_outline_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="top_menu_color" class="col-3 col-form-label">Menu Color</label>
                        <div class="col-9" title="Top Menu Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="top_menu_color" name="top_menu_color" class="form-control" placeholder="Top Menu Color" required>
                            @else
                                <input type="text" id="top_menu_color" name="top_menu_color" value="{{ $theme->top_menu_color }}" class="form-control" placeholder="Top Menu Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->top_menu_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="top_menu_h_color" class="col-3 col-form-label">Menu H Color</label>
                        <div class="col-9" title="Top Menu Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="top_menu_h_color" name="top_menu_h_color" class="form-control" placeholder="Top Menu Highlight Color" required>
                            @else
                                <input type="text" id="top_menu_h_color" name="top_menu_h_color" value="{{ $theme->top_menu_hilite_color }}" class="form-control" placeholder="Top Menu Highlight Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->top_menu_hilite_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="menu_color" class="col-3 col-form-label">Menu Color</label>
                        <div class="col-9" title="Menu Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="menu_color" name="menu_color" class="form-control" placeholder="Menu Color" required>
                            @else
                                <input type="text" id="menu_color" name="menu_color" value="{{ $theme->menu_color }}" class="form-control" placeholder="Menu Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->menu_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="menu_h_color" class="col-3 col-form-label">Menu H Color</label>
                        <div class="col-9" title="Menu Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="menu_h_color" name="menu_h_color" class="form-control" placeholder="Menu Highlight Color" required>
                            @else
                                <input type="text" id="menu_h_color" name="menu_h_color" value="{{ $theme->menu_hilite_color }}" class="form-control" placeholder="Menu Highlight Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->menu_hilite_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="footer_header_color" class="col-3 col-form-label">Footer Color</label>
                        <div class="col-9" title="Footer Header Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="footer_header_color" name="footer_header_color" class="form-control" placeholder="Footer Header Color" required>
                            @else
                                <input type="text" id="footer_header_color" name="footer_header_color" value="{{ $theme->footer_header_color }}" class="form-control" placeholder="Footer Header Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->footer_header_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="footer_header_size" class="col-3 col-form-label">Footer Size</label>
                        <div class="col-9" title="Footer Header Size" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="footer_header_size" name="footer_header_size" value="23" class="form-control" placeholder="Footer Header Size" required>
                            @else
                                <input type="text" id="footer_header_size" name="footer_header_size" value="{{ intval($theme->footer_header_size) }}" class="form-control" placeholder="Footer Header Size" required>
                            @endif
                            @yield('units')
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer_link_color" class="col-3 col-form-label">Footer Color</label>
                        <div class="col-9" title="Footer Link Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="footer_link_color" name="footer_link_color" class="form-control" placeholder="Footer Link Color" required>
                            @else
                                <input type="text" id="footer_link_color" name="footer_link_color" value="{{ $theme->footer_link_color }}" class="form-control" placeholder="Footer Link Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->footer_link_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="footer_link_h_color" class="col-3 col-form-label">Footer H Color</label>
                        <div class="col-9" title="Footer Link Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="footer_link_h_color" name="footer_link_h_color" class="form-control" placeholder="Footer Link Highlight Color" required>
                            @else
                                <input type="text" id="footer_link_h_color" name="footer_link_h_color" value="{{ $theme->footer_link_hilite_color }}" class="form-control" placeholder="Footer Link Highlight Color" required>
                            @endif
                        </div>
                        @if ($page_theme_id == 0)
                            <div class="tradivas-color-view"></div>
                        @else
                            <div class="tradivas-color-view" style="background-color: {{ $theme->footer_link_hilite_color }};"></div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="footer_link_size" class="col-3 col-form-label">Footer Size</label>
                        <div class="col-9" title="Footer Link Size" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="text" id="footer_link_size" name="footer_link_size" value="14" class="form-control" placeholder="Footer Link Size" required>
                            @else
                                <input type="text" id="footer_link_size" name="footer_link_size" value="{{ intval($theme->footer_link_size) }}" class="form-control" placeholder="Footer Link Size" required>
                            @endif
                            @yield('units')
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        @if ($page_theme_id == 0)
                            <button type="submit" class="btn login-btn tradivas-btn">Create Theme</button>
                        @else
                            <button type="submit" class="btn login-btn tradivas-btn">Update Theme</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jqueryui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colorpicker/jquery.colorpicker.css') }}">
    <style>
        .tradivas-theme-container .col-9{
            display: inline-block;
        }
        .tradivas-color-view{
            display: inline-block;
            margin: 11px 0 0 -40px;
            width: 16px;
            height: 16px;
            border: 1px solid #000;
            z-index: 1;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.colorpicker.js') }}"></script>
    <script>
        $(function(){
            $(".tradivas-color-view").each(function(){
                var input = $(this).siblings(1).children().eq(0);
                input.focus(function(){
                    $(this).colorpicker({
                        color: $(this).val(),
                        colorFormat: "#HEX",
                    });
                });
                input.change(function(){
                    $(".tradivas-color-view", $(this).parent().parent()).css({
                        "background-color": $(this).val(),
                    });
                });
            });
        });
    </script>
@endpush
