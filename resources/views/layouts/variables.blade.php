@guest
    <?php $theme_id = Cookie::get("theme_id", 1) ?>
@else
    <?php $theme_id = session("theme_id", 1) ?>
@endguest
<?php
    $theme = App\Theme::find($theme_id);
    if (!$theme)
        $theme = App\Theme::first();

    if ($theme){
        $page_update = $theme->page_update()->where('page', Request::path())->first();
        if ($page_update){
            $theme->bg_color_start_proportion += $page_update->bg_color_start_proportion;
        }
    }
?>
<style>
    @if($theme)
        :root {
            --tradivas-bg-color-start: {{ $theme->bg_color_start }};
            --tradivas-bg-color-stop: {{ $theme->bg_color_stop }};
            --tradivas-bg-color-start-proportion: {{ (string)$theme->bg_color_start_proportion . "%" }};
            --tradivas-bg-rule-color: {{ $theme->bg_rule_color }};
            --tradivas-bg-rule-width: {{ $theme->bg_rule_width }};
            --tradivas-bg-rule-style: {{ $theme->bg_rule_style }};
            --tradivas-btn-bg-color: {{ $theme->btn_bg_color }};
            --tradivas-btn-bg-hilite-color: {{ $theme->btn_bg_hilite_color }};
            --tradivas-btn-color: {{ $theme->btn_color }};
            --tradivas-btn-hilite-color: {{ $theme->btn_hilite_color }};
            --tradivas-input-outline-color: {{ $theme->input_outline_color }};
            --tradivas-top-menu-color: {{ $theme->top_menu_color }};
            --tradivas-top-menu-hilite-color: {{ $theme->top_menu_hilite_color }};
            --tradivas-menu-color: {{ $theme->menu_color }};
            --tradivas-menu-hilite-color: {{ $theme->menu_hilite_color }};
            --tradivas-footer-header-color: {{ $theme->footer_header_color }};
            --tradivas-footer-header-size: {{ $theme->footer_header_size }};
            --tradivas-footer-link-size: {{ $theme->footer_link_size }};
            --tradivas-footer-link-color: {{ $theme->footer_link_color }};
            --tradivas-footer-link-hilite-color: {{ $theme->footer_link_hilite_color }};
        }
    @else
        :root {
            --tradivas-bg-color-start: pink;
            --tradivas-bg-color-stop: white;
            --tradivas-bg-color-start-proportion: 10px;
            --tradivas-bg-rule-color: pink;
            --tradivas-bg-rule-width: 1px;
            --tradivas-bg-rule-style: solid;
            --tradivas-btn-bg-color: pink;
            --tradivas-btn-bg-hilite-color: lightpink;
            --tradivas-btn-color: black;
            --tradivas-btn-hilite-color: #777;
            --tradivas-input-outline-color: pink;
            --tradivas-top-menu-color: black;
            --tradivas-top-menu-hilite-color: #777;
            --tradivas-menu-color: black;
            --tradivas-menu-hilite-color: #777;
            --tradivas-footer-header-color: black;
            --tradivas-footer-header-size: 23px;
            --tradivas-footer-link-size: 14px;
            --tradivas-footer-link-color: #444;
            --tradivas-footer-link-hilite-color: #777;
        }
    @endif
</style>