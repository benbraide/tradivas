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
            $items_db = $this->filterQuery($request, \App\Item::where('category', $category->id)->where('sub_category', $sub_category->id));
        else
            $items_db = $this->filterQuery($request, \App\Item::where('category', $category->id));

        return view('items', [
            'link' => $link,
            'category' => $category,
            'sub_category' => $sub_category,
            'items' => $this->paginate($request, $items_db)
        ]);
    }

    public function show(Request $request, $serial){
        return view('item', [
            'item' => \App\Item::where('serial', $serial)->firstOrFail()
        ]);
    }

    public function filterQuery($request, $query){
        $sort_by = $request->input("sort", null);
        if ($sort_by){
            $sort = \App\Sort::where("label", $sort_by)->orWhere("id", $sort_by)->first();
            if ($sort){
                if ($sort->column == '?'){

                }
                else
                    $query->orderBy($sort->column, $sort->direction);
            }
            else
                $query->latest();
        }
        else
            $query->latest();

        return $query;
    }

    public function paginate($request, $query){
        $result = $query->paginate($request->input("limit", 4));
        if ($request->has('sort'))
            $result->appends(['sort' => $request->input('sort')]);
        return $result;
    }
}
