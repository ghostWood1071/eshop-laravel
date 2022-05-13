<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $incrementing = false;

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function colors(){
        return $this->hasMany(Color::class,'product_id','id');
    }

    
}
