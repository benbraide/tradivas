@php

$settings = App\Setting::first();
$global_theme_id = ($settings ? $settings->theme_id : 1);

@endphp

@guest
    <?php $theme_id = Cookie::get("theme_id", 0) ?>
@else
    <?php $theme_id = Auth::user()->theme_id ?>
@endguest
<?php
    $theme = App\Theme::find(($theme_id == 0) ? $global_theme_id : $theme_id);
    if (!$theme)
        $theme = App\Theme::first();
?>
<style>
    @if($theme)
        :root {
            --tradivas-bg-color-start: {{ "#" . $theme->bg_color_start }};
            --tradivas-bg-color-stop: {{ "#" . $theme->bg_color_stop }};
            --tradivas-bg-color-start-proportion: {{ (string)$theme->bg_color_start_proportion . "%" }};
            --tradivas-bg-rule-color: {{ "#" . $theme->bg_rule_color }};
            --tradivas-bg-rule-width: {{ $theme->bg_rule_width . "px" }};
            --tradivas-bg-rule-style: {{ $theme->bg_rule_style }};
            --tradivas-btn-bg-color: {{ "#" . $theme->btn_bg_color }};
            --tradivas-btn-bg-hilite-color: {{ "#" . $theme->btn_bg_hilite_color }};
            --tradivas-btn-color: {{ "#" . $theme->btn_color }};
            --tradivas-btn-hilite-color: {{ "#" . $theme->btn_hilite_color }};
            --tradivas-input-outline-color: {{ "#" . $theme->input_outline_color }};
            --tradivas-top-menu-color: {{ "#" . $theme->top_menu_color }};
            --tradivas-top-menu-hilite-color: {{ "#" . $theme->top_menu_hilite_color }};
            --tradivas-menu-color: {{ "#" . $theme->menu_color }};
            --tradivas-menu-hilite-color: {{ "#" . $theme->menu_hilite_color }};
            --tradivas-footer-header-color: {{ "#" . $theme->footer_header_color }};
            --tradivas-footer-header-size: {{ $theme->footer_header_size . "px" }};
            --tradivas-footer-link-size: {{ $theme->footer_link_size . "px" }};
            --tradivas-footer-link-color: {{ "#" . $theme->footer_link_color }};
            --tradivas-footer-link-hilite-color: {{ "#" . $theme->footer_link_hilite_color }};
        }
    @else
        :root {
            --tradivas-bg-color-start: #FFC0CB;
            --tradivas-bg-color-stop: #FFF;
            --tradivas-bg-color-start-proportion: 72%;
            --tradivas-bg-rule-color: #FFC0CB;
            --tradivas-bg-rule-width: 1px;
            --tradivas-bg-rule-style: solid;
            --tradivas-btn-bg-color: #FFC0CB;
            --tradivas-btn-bg-hilite-color: #FFB6C1;
            --tradivas-btn-color: #000;
            --tradivas-btn-hilite-color: #000;
            --tradivas-input-outline-color: #FFC0CB;
            --tradivas-top-menu-color: #000;
            --tradivas-top-menu-hilite-color: #777;
            --tradivas-menu-color: #000;
            --tradivas-menu-hilite-color: #777;
            --tradivas-footer-header-color: #000;
            --tradivas-footer-header-size: 23px;
            --tradivas-footer-link-size: 14px;
            --tradivas-footer-link-color: #444;
            --tradivas-footer-link-hilite-color: #777;
        }
    @endif
</style>