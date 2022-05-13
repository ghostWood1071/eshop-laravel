<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use App\Models\Image;
use Illuminate\Support\Str;

class ColorController extends Controller
{
   
    public function index()
    {
        
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        return DB::select('CALL get_colors(?)',array($id));
    }

   
    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $color->name = $request->color['name'];
        $color->value = $request->color['value'];
        $color->discount = $request->color['discount'];
        $color->save();

        if(count($request->images) > 0){
            $images = $request->images;
            foreach($images as $img){
                $image = new Image;
                $image->id = Str::uuid()->toString();
                $image->color_id = $color->id;
                $image->name = $img;
                $image->active = 1;
                $image->save();
            }
            return $images;
        }
        return $color;
        
    }

    
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->active = 0;
        $color->save();
        return $color;
    }
}
