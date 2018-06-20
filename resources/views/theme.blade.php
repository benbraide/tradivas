@extends('layouts.master')

@if ($page_theme_id == 0)
    @section('title', "Create New Theme")
@else
    @section('title', "Theme Preview")
@endif

@section('rule_styles')
    <?php
        $styles = array('solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset', 'initial');
        if ($page_theme_id == 0){
            if (!App\Theme::first()){
                $page_theme_id = 1;
                $theme = new App\Theme;
                $theme->bg_color_start = '#FFC0CB';
                $theme->bg_color_stop = '#FFFFFF';
                $theme->bg_color_start_proportion = '72%';
                $theme->bg_rule_color = '#FFC0CB';
                $theme->bg_rule_width = '1px';
                $theme->bg_rule_style = 'solid';
                $theme->btn_bg_color = '#FFC0CB';
                $theme->btn_bg_hilite_color = '#FFB6C1';
                $theme->btn_color = '#000000';
                $theme->btn_hilite_color = '#000000';
                $theme->input_outline_color = '#FFC0CB';
                $theme->top_menu_color = '#000000';
                $theme->top_menu_hilite_color = '#777777';
                $theme->menu_color = '#000000';
                $theme->menu_hilite_color = '#777777';
                $theme->footer_header_color = '#000000';
                $theme->footer_header_size = '23px';
                $theme->footer_link_size = '14px';
                $theme->footer_link_color = '#444444';
                $theme->footer_link_hilite_color = '#777777';
            }
            else
                $theme = null;
        }
        else
            $theme = App\Theme::find($page_theme_id);
    ?>
    <select id="rule_style" name="rule_style" class="form-control">
        @foreach ($styles as $style)
            @if (($page_theme_id == 0 && $style == "solid") || ($page_theme_id != 0 && $theme->bg_rule_style == $style))
                <option value="{{ $style }}" selected="selected">{{ ucfirst($style) }}</option>
            @else
                <option value="{{ $style }}">{{ ucfirst($style) }}</option>
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
                                <input type="color" id="color_start" name="color_start" class="form-control" placeholder="Header Start Color" required>
                            @else
                                <input type="color" id="color_start" name="color_start" value="{{ $theme->bg_color_start }}" class="form-control" placeholder="Header Start Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_end" class="col-3 col-form-label">End Color</label>
                        <div class="col-9" title="Header End Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="color_end" name="color_end" class="form-control" placeholder="Header End Color" required>
                            @else
                                <input type="color" id="color_end" name="color_end" value="{{ $theme->bg_color_stop }}" class="form-control" placeholder="Header End Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_proportion" class="col-3 col-form-label">Proportion</label>
                        <div class="col-9" title="Header Color Proportion" data-toggle="tooltip">
                            <?php
                                if ($page_theme_id != 0){
                                    $matches = array();
                                    preg_match('/([\d.]+)(.+)/', $theme->bg_color_start_proportion, $matches);
                                }
                                else
                                    $matches = array("", "72", "px");
                            ?>
                            <input type="text" id="color_proportion" name="color_proportion" value="{{ $matches[1] }}" class="form-control" placeholder="Header Color Proportion" required>
                            @include('inc.unit', [
                                "unit_name" => "color_proportion_unit",
                                "active_unit" => $matches[2]
                            ])
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rule_color" class="col-3 col-form-label">Rule Color</label>
                        <div class="col-9" title="Rule Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="rule_color" name="rule_color" class="form-control" placeholder="Rule Color" required>
                            @else
                                <input type="color" id="rule_color" name="rule_color" value="{{ $theme->bg_rule_color }}" class="form-control" placeholder="Rule Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rule_width" class="col-3 col-form-label">Rule Width</label>
                        <div class="col-9" title="Rule Width" data-toggle="tooltip">
                            <?php
                                if ($page_theme_id != 0){
                                    $matches = array();
                                    preg_match('/([\d.]+)(.+)/', $theme->bg_rule_width, $matches);
                                }
                                else
                                    $matches = array("", "1", "px");
                            ?>
                            <input type="text" id="rule_width" name="rule_width" value="{{ $matches[1] }}" class="form-control" placeholder="Rule Width" required>
                            @include('inc.unit', [
                                "unit_name" => "rule_width_unit",
                                "active_unit" => $matches[2]
                            ])
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
                                <input type="color" id="btn_bg_color" name="btn_bg_color" class="form-control" placeholder="Button Background Color" required>
                            @else
                                <input type="color" id="btn_bg_color" name="btn_bg_color" value="{{ $theme->btn_bg_color }}" class="form-control" placeholder="Button Background Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="btn_bgh_color" class="col-3 col-form-label">Btn Bgh Color</label>
                        <div class="col-9" title="Button Background Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="btn_bgh_color" name="btn_bgh_color" class="form-control" placeholder="Button Background Highlight Color" required>
                            @else
                                <input type="color" id="btn_bgh_color" name="btn_bgh_color" value="{{ $theme->btn_bg_hilite_color }}" class="form-control" placeholder="Button Background Highlight Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="btn_color" class="col-3 col-form-label">Button Color</label>
                        <div class="col-9" title="Button Text Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="btn_color" name="btn_color" class="form-control" placeholder="Button Color" required>
                            @else
                                <input type="color" id="btn_color" name="btn_color" value="{{ $theme->btn_color }}" class="form-control" placeholder="Button Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="btn_h_color" class="col-3 col-form-label">Button H Color</label>
                        <div class="col-9" title="Button Text Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="btn_h_color" name="btn_h_color" class="form-control" placeholder="Button Highlight Color" required>
                            @else
                                <input type="color" id="btn_h_color" name="btn_h_color" value="{{ $theme->btn_hilite_color }}" class="form-control" placeholder="Button Highlight Color" required>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="outline_color" class="col-3 col-form-label">Outline Color</label>
                        <div class="col-9" title="Input Outline Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="outline_color" name="outline_color" class="form-control" placeholder="Input Outline Color" required>
                            @else
                                <input type="color" id="outline_color" name="outline_color" value="{{ $theme->input_outline_color }}" class="form-control" placeholder="Input Outline Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="top_menu_color" class="col-3 col-form-label">Menu Color</label>
                        <div class="col-9" title="Top Menu Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="top_menu_color" name="top_menu_color" class="form-control" placeholder="Top Menu Color" required>
                            @else
                                <input type="color" id="top_menu_color" name="top_menu_color" value="{{ $theme->top_menu_color }}" class="form-control" placeholder="Top Menu Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="top_menu_h_color" class="col-3 col-form-label">Menu H Color</label>
                        <div class="col-9" title="Top Menu Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="top_menu_h_color" name="top_menu_h_color" class="form-control" placeholder="Top Menu Highlight Color" required>
                            @else
                                <input type="color" id="top_menu_h_color" name="top_menu_h_color" value="{{ $theme->top_menu_hilite_color }}" class="form-control" placeholder="Top Menu Highlight Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="menu_color" class="col-3 col-form-label">Menu Color</label>
                        <div class="col-9" title="Menu Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="menu_color" name="menu_color" class="form-control" placeholder="Menu Color" required>
                            @else
                                <input type="color" id="menu_color" name="menu_color" value="{{ $theme->menu_color }}" class="form-control" placeholder="Menu Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="menu_h_color" class="col-3 col-form-label">Menu H Color</label>
                        <div class="col-9" title="Menu Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="menu_h_color" name="menu_h_color" class="form-control" placeholder="Menu Highlight Color" required>
                            @else
                                <input type="color" id="menu_h_color" name="menu_h_color" value="{{ $theme->menu_hilite_color }}" class="form-control" placeholder="Menu Highlight Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer_header_color" class="col-3 col-form-label">Footer Color</label>
                        <div class="col-9" title="Footer Header Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="footer_header_color" name="footer_header_color" class="form-control" placeholder="Footer Header Color" required>
                            @else
                                <input type="color" id="footer_header_color" name="footer_header_color" value="{{ $theme->footer_header_color }}" class="form-control" placeholder="Footer Header Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer_header_size" class="col-3 col-form-label">Footer Size</label>
                        <div class="col-9" title="Footer Header Size" data-toggle="tooltip">
                            <?php
                                if ($page_theme_id != 0){
                                    $matches = array();
                                    preg_match('/([\d.]+)(.+)/', $theme->footer_header_size, $matches);
                                }
                                else
                                    $matches = array("", "23", "px");
                            ?>
                            <input type="text" id="footer_header_size" name="footer_header_size" value="{{ $matches[1] }}" class="form-control" placeholder="Footer Header Size" required>
                            @include('inc.unit', [
                                "unit_name" => "footer_header_size_unit",
                                "active_unit" => $matches[2]
                            ])
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer_link_color" class="col-3 col-form-label">Footer Color</label>
                        <div class="col-9" title="Footer Link Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="footer_link_color" name="footer_link_color" class="form-control" placeholder="Footer Link Color" required>
                            @else
                                <input type="color" id="footer_link_color" name="footer_link_color" value="{{ $theme->footer_link_color }}" class="form-control" placeholder="Footer Link Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer_link_h_color" class="col-3 col-form-label">Footer H Color</label>
                        <div class="col-9" title="Footer Link Highlight Color" data-toggle="tooltip">
                            @if ($page_theme_id == 0)
                                <input type="color" id="footer_link_h_color" name="footer_link_h_color" class="form-control" placeholder="Footer Link Highlight Color" required>
                            @else
                                <input type="color" id="footer_link_h_color" name="footer_link_h_color" value="{{ $theme->footer_link_hilite_color }}" class="form-control" placeholder="Footer Link Highlight Color" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer_link_size" class="col-3 col-form-label">Footer Size</label>
                        <div class="col-9" title="Footer Link Size" data-toggle="tooltip">
                            <?php
                                if ($page_theme_id != 0){
                                    $matches = array();
                                    preg_match('/([\d.]+)(.+)/', $theme->footer_link_size, $matches);
                                }
                                else
                                    $matches = array("", "14", "px");
                            ?>
                            <input type="text" id="footer_link_size" name="footer_link_size" value="{{ $matches[1] }}" class="form-control" placeholder="Footer Link Size" required>
                            @include('inc.unit', [
                                "unit_name" => "footer_link_size_unit",
                                "active_unit" => $matches[2]
                            ])
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
    <style>
        input[type=color].form-control{
            padding: 0px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function valueChanged(){
            var target = $(this).attr("id");
            if (target === "color_start")
                $("html").get(0).style.setProperty("--tradivas-bg-color-start", $(this).val());
            else if (target === "color_end")
                $("html").get(0).style.setProperty("--tradivas-bg-color-stop", $(this).val());
            else if (target === "color_proportion")
                $("html").get(0).style.setProperty("--tradivas-bg-color-start-proportion", ($(this).val() + $(this).siblings().eq(0).val()));
            else if (target === "rule_color")
                $("html").get(0).style.setProperty("--tradivas-bg-rule-color", $(this).val());
            else if (target === "rule_width")
                $("html").get(0).style.setProperty("--tradivas-bg-rule-width", ($(this).val() + $(this).siblings().eq(0).val()));
            else if (target === "rule_style")
                $("html").get(0).style.setProperty("--tradivas-bg-rule-style", $(this).val());
            else if (target === "btn_bg_color")
                $("html").get(0).style.setProperty("--tradivas-btn-bg-color", $(this).val());
            else if (target === "btn_bgh_color")
                $("html").get(0).style.setProperty("--tradivas-btn-bg-hilite-color", $(this).val());
            else if (target === "btn_color")
                $("html").get(0).style.setProperty("--tradivas-btn-color", $(this).val());
            else if (target === "btn_h_color")
                $("html").get(0).style.setProperty("--tradivas-btn-hilite-color", $(this).val());
            else if (target === "outline_color")
                $("html").get(0).style.setProperty("--tradivas-input-outline-color", $(this).val());
            else if (target === "top_menu_color")
                $("html").get(0).style.setProperty("--tradivas-top-menu-color", $(this).val());
            else if (target === "top_menu_h_color")
                $("html").get(0).style.setProperty("--tradivas-top-menu-hilite-color", $(this).val());
            else if (target === "menu_color")
                $("html").get(0).style.setProperty("--tradivas-menu-color", $(this).val());
            else if (target === "menu_h_color")
                $("html").get(0).style.setProperty("--tradivas-menu-hilite-color", $(this).val());
            else if (target === "footer_header_color")
                $("html").get(0).style.setProperty("--tradivas-footer-header-color", $(this).val());
            else if (target === "footer_header_size")
                $("html").get(0).style.setProperty("--tradivas-footer-header-size", ($(this).val() + $(this).siblings().eq(0).val()));
            else if (target === "footer_link_size")
                $("html").get(0).style.setProperty("--tradivas-footer-link-size", ($(this).val() + $(this).siblings().eq(0).val()));
            else if (target === "footer_link_color")
                $("html").get(0).style.setProperty("--tradivas-footer-link-color", $(this).val());
            else if (target === "footer_link_h_color")
                $("html").get(0).style.setProperty("--tradivas-footer-link-hilite-color", $(this).val());
        }
        
        $(function(){
            $("div.col-9 > input").change(valueChanged);
            $("div.col-9 > select:not(.tradivas-unit)").change(valueChanged);

            $("div.col-9 > select.tradivas-unit").change(function(){
                var boundValueChanged = valueChanged.bind($(this).siblings().get(0));
                boundValueChanged();
            });
        });
    </script>
@endpush
