<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller{
    public function listCategory(Request $request, $link){
        $category = \App\Category::where('link', $link)->first();
        if (!$category){
            $sub_category = \App\SubCategory::where('link', $link)->first();
            if (!$sub_category)
                return redirect("home");
            $category = $sub_category->category;
        }
        else
            $sub_category = null;

        if ($sub_category)
            $items = \App\Item::where('category', $category->id)->where('sub_category', $sub_category->id)->paginate(35);
        else
            $items = \App\Item::where('category', $category->id)->paginate(35);

        return view('items', [
            'link' => $link,
            'category' => $category,
            'sub_category' => $sub_category,
            'items' => $items
        ]);
    }
}
