<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Storage;
class Ultilities implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //
    }

    
    public static function getFileName($fileName){
        if(Storage::disk('publics')->exists('upload/'.$fileName)>0){
            $files =  Storage::disk('publics')->allFiles('upload');
            $count = 0;
            foreach($files as $f)
                if(preg_match('/'.$fileName.'/', $f))
                    $count+=1;
            $size = strlen ($fileName);
            $pos = $size - strpos(strrev($fileName), '.',1) - 1;
            $fileName = substr($fileName, 0, $pos).'('.$count.')'.substr($fileName, $pos, $size-1);
        }
        return $fileName;
    }
    
    public static function checkFileName($fileName){
        if (Storage::disk('publics')->exists($fileName)) {
            // Split filename into parts
            $pathInfo = pathinfo($fileName);
            $extension = isset($pathInfo['extension']) ? ('.' . $pathInfo['extension']) : '';
        
            // Look for a number before the extension; add one if there isn't already
            if (preg_match('/(.*?)(\d+)$/', $pathInfo['filename'], $match)) {
                // Have a number; get it
                $base = $match[1];
                $number = intVal($match[2]);
            } else {
                // No number; pretend we found a zero
                $base = $pathInfo['filename'];
                $number = 0;
            }
        
            // Choose a name with an incremented number until a file with that name 
            // doesn't exist
            do {
                $fileName = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $base . ++$number . $extension;
            } while (Storage::disk('publics')->exists($fileName));
        }
        
        return $fileName;
    }
}
