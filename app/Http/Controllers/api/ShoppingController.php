<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Price;
use App\Models\Size;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShoppingController extends Controller
{

    public function getProducts(){
        $colors = Color::where('active', 1)->get();
        foreach($colors as $color){
            $color->product;
            $color->price;
            $color->image;
        }
        return $colors;
    } 

    public function getSales($n){
        $colors = Color::where('active', 1)->where('discount', '>', '0')->get();
        foreach($colors as $color){
            $color->product;
            $color->price;
            $color->image;
        }
        return $colors;
    }

    public function getHot($cate_id, $n){
        return DB::select('CALL get_trending(?, ?)',array($cate_id=='null'?null:$cate_id, $n));
    }

    public function getNew($n){
        // return DB::select('CALL get_new_products(?)', array($n));
        $colors = Color::where('active',1)->limit($n)->get();
        foreach($colors as $color){
            $color->productNew;
            $color->image;
            $color->price;
        }
        return $colors->where('productNew', '!=', null);
    }

    public function getProduct($id){
        $product =  Product::where('active', 1)->where('id', $id)->first();
        $product->category;
        return $product;
    }

    public function getCategories(){
        return Category::where('active', 1)->get();
    }

    public function getColors($id){
        $colors = Color::where('active', 1)->where('product_id', $id)->get();
        foreach($colors as $color){
            $color->price;
        }
        return $colors;
    }

    public function getSizes($id){
        return Size::where('active', 1)->where('color_id', $id)->get();
    }

    public function getImages($id){
        return Image::where('active', 1)->where('color_id', $id)->get();
    }

    public function getPrice($id){
        return Price::where('active',1)->where('color_id', $id)->get();
    }

    public function createUser(Request $request){
        $check = User::where('active', 1)->where('account', $request->account)->first();
        if($check != null)
            return false;
        $user = new User;
        $user->id = Str::uuid()->toString();
        $user->fullname = $request->fullname;
        $user->account = $request->account;
        $user->password = $request->password; 
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 2;
        $user->active = 1;
        $user->save();
        return true;
    }

}
