<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller{
    public function createSize(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");
        
        $values = explode(" ", $request->input("sizes"));
        foreach ($values as $value){
            if (!\App\Size::find($value)){
                \App\Size::create([
                    'value' => (float)$value,
                ]);
            }
        }

        return redirect("admin");
    }

    public function createColor(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");
        
        \App\Color::create([
            'name' => $request->input("color_name"),
            'value' => $request->input("color_value"),
        ]);
        
        return redirect("admin");
    }

    public function createItem(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");

        $item = new \App\Item;
        $item->title = $request->input("title");
        $item->description = $request->input("description");
        $item->price = $request->input("price");
        $item->category = $request->input("category");
        $item->sub_category = $request->input("sub_category", 0);
        $item->serial = str_random(30);
        $item->save();

        foreach ($request->input("colors") as $color){
            $color_db = \App\Color::where("value", $color)->first();
            foreach ($request->input("sizes") as $size){
                $stock = new \App\Stock;
                $stock->item_id = $item->id;
                $stock->color_id = $color_db->id;
                $stock->size_id = $size;
                $stock->count = $request->input("stock");
                $stock->save();
            }
        }

        if ($request->hasFile('cover')){
            $image_mod = new \App\Image;
            $image_mod->item_id = $item->id;
            $image_mod->name = basename($request->file('cover')->store('images/' . $item->serial));
            $image_mod->save();
        }
        
        if ($request->hasFile('images')){
            foreach ($request->file('images') as $image){
                $image_mod = new \App\Image;
                $image_mod->item_id = $item->id;
                $image_mod->name = basename($image->store('images/' . $item->serial));
                $image_mod->save();
            }
        }
        
        return redirect("admin");
    }

    public function updateSettings(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");

        $setting = \App\Setting::first();
        if (!$setting)
            $setting = new \App\Setting;
        
        $setting->theme_id = $request->input("theme_id");
        $setting->images_base = $request->input("images_base");
        $setting->default_path = $request->input("default_path");
        $setting->default_image = $request->input("default_image");
        $setting->logo = $request->input("logo");
        $setting->save();
        
        return redirect("admin");
    }

    public function updateTheme(Request $request, $id){
        if (!Auth::user()->is_admin())
            return redirect("/");

        if ($id == 0)
            $theme = new \App\Theme;
        else
            $theme = \App\Theme::find($id);
        
        $theme->name = $request->input("name");
        $theme->bg_color_start = $request->input("color_start");
        $theme->bg_color_stop = $request->input("color_end");
        $theme->bg_color_start_proportion = ($request->input("color_proportion") . $request->input("color_proportion_unit", "px"));
        $theme->bg_rule_color = $request->input("rule_color");
        $theme->bg_rule_width = ($request->input("rule_width") . $request->input("rule_width_unit", "px"));
        $theme->bg_rule_style = $request->input("rule_style");
        $theme->btn_bg_color = $request->input("btn_bg_color");
        $theme->btn_bg_hilite_color = $request->input("btn_bgh_color");
        $theme->btn_color = $request->input("btn_color");
        $theme->btn_hilite_color = $request->input("btn_h_color");
        $theme->input_outline_color = $request->input("outline_color");
        $theme->top_menu_color = $request->input("top_menu_color");
        $theme->top_menu_hilite_color = $request->input("top_menu_h_color");
        $theme->menu_color = $request->input("menu_color");
        $theme->menu_hilite_color = $request->input("menu_h_color");
        $theme->footer_header_color = $request->input("footer_header_color");
        $theme->footer_header_size = ($request->input("footer_header_size") . $request->input("footer_header_size_unit", "px"));
        $theme->footer_link_size = ($request->input("footer_link_size") . $request->input("footer_link_size_unit", "px"));
        $theme->footer_link_color = $request->input("footer_link_color");
        $theme->footer_link_hilite_color = $request->input("footer_link_h_color");
        $theme->save();
            
        return redirect("admin");
    }

    public function createCategory(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");

        $cat = new \App\Category;
        $cat->name = ucwords($request->input("cat_name"));
        $cat->link = strtolower(str_slug($cat->name));
        $cat->save();

        return redirect("admin");
    }

    public function createSubCategory(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");

        $sub_cat = new \App\SubCategory;
        $sub_cat->category_id = $request->input("category");
        $sub_cat->name = ucwords($request->input("sub_cat_name") . " " . \App\Category::find($sub_cat->category_id)->name);
        $sub_cat->link = strtolower(str_slug($sub_cat->name));
        $sub_cat->save();

        return redirect("admin");
    }
    
    public function getSubCategories(Request $request, $id){
        $cat = \App\Category::find($id);
        return ($cat ? $cat->subCategories->toArray() : []);
    }
}
