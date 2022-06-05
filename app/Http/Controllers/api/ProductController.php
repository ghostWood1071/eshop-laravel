<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    //get all
    public function index()
    {
        return DB::select('CALL get_products(?)',array(null));
    }

    //save row
    public function store(Request $request)
    {
        $product = new Product;
        $product->id = Str::uuid()->toString();
        $product->name = $request->product['name'];
        $product->release_date = Carbon::parse($request->product['release_date'])->format('Y-m-d');
        $product->active = 1;
        $product->category_id = $request->product['category_id'];
        $product->save();

        //insert colors
        $colors = array();
        foreach($request->colors as $c){
            $color = new Color;
            $color->id = Str::uuid()->toString();
            $color->name = $c['name'];
            $color->value = $c['value'];
            $color->discount = $c['discount'];
            $color->active = 1;
            $color->product_id = $product->id;
            $color->save();
            array_push($colors, $color);
        }

        //save image file
        $images = array();
        for($i = 0; $i<count($colors); $i++){
            $image = new Image;
            $image->id = Str::uuid()->toString();
            $image->color_id =  $colors[$i]->id;
            $image->name = $request->fs[$i];
            $image->active = 1;
            $image->save();
        }
        return DB::select('CALL get_products(?)',array($product->id));
        
    }
    
    //update row
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->category_id = $request->product['category_id'];
        $product->name = $request->product['name'];
        $product->release_date = Carbon::parse($request->product['release_date'])->format('Y-m-d');
        $product->save();

        if(count($request->colors)>0){
            $colors = array();
            foreach($request->colors as $c){
                $color = new Color;
                $color->id = Str::uuid()->toString();
                $color->name = $c['name'];
                $color->value = $c['value'];
                $color->discount = $c['discount'];
                $color->active = 1;
                $color->product_id = $product->id;
                $color->save();
                array_push($colors, $color);
            }

            for($i = 0; $i<count($colors); $i++){
                $image = new Image;
                $image->id = Str::uuid()->toString();
                $image->color_id =  $colors[$i]->id;
                $image->name = $request->images[$i];
                $image->active = 1;
                $image->save();
            }
        }
        return DB::select('CALL get_products(?)',array($product->id));
        
    }

    //delete row
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->active = 0;
        $product->save();
    }

    public function create(){
        $colors = Color::where('active',1)->get();
        foreach($colors as $color){
            $color->product;
            $color->image;
            $color->price;
        }
        return $colors;
    }

    
}
