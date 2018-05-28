<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller{
    public function __construct() {
        $this->middleware('auth');
    }

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
        return redirect("admin");
    }

    public function updateSettings(Request $request){
        if (!Auth::user()->is_admin())
            return redirect("/");

        $setting = \App\Setting::first();
        $setting->theme_id = $request->input("theme_id");
        $setting->images_base = $request->input("images_base");
        $setting->save();
        
        return redirect("admin");
    }
}
