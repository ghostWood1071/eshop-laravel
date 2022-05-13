<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scopes\Ultilities;
use Carbon\Carbon;
class FileController extends Controller
{
    
    public function index()
    {
       
    }

   
    public function create()
    {
       
    }

    public function store(Request $request)
    {
        $files = $request->file('file');
        $file_names = array();
        if($request->hasFile('file'))
        {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $name = Ultilities::checkFileName($name);
                array_push($file_names, $name);
                $file->storeAs('upload', $name, 'publics');
            }
            return $file_names;
        } else return "no attachment";
    }

    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
       
    }

    
    public function update(Request $request, $id)
    {
        
    }

    
    public function destroy($id)
    {
        
    }

    
}
