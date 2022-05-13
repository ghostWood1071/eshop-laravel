<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
    }

   
    public function show($id)
    {
        return Image::where('color_id', '=', $id, 'and')->where('active', '=', 1)->get();
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->active = 0;
        $image->save();
        return $image;
    }
}
