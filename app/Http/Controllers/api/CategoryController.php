<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Image;
use App\Models\Size;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //get all
    public function index()
    {
        return Category::where('active', 1)->get();
    }

    //save category
    public function store(Request $request)
    {
        $id = Str::uuid()->toString();
        $cate = new Category;
        $cate->id = $id;
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->active = 1;
        $cate->save();
        return $cate;
    }

    //update category
    public function update(Request $request, $id)
    {
        $cate = Category::find($id);
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->save();
        return $cate;
    }

    //delete category
    public function destroy($id)
    {
        $cate = Category::find($id);
        $cate->active = 0;
        $cate->save();
        return $cate;
    }

    
}
