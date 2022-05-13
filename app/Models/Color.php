<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Color extends Model
{
    use HasFactory;
    protected $table = 'color';
    public $incrementing = false;

    public function images(){
        return $this->hasMany(Image::class, 'color_id', 'id');
    }
    public function sizes(){
        return $this->hasMany(Size::class, 'color_id', 'id');
    }

    public function image(){
        return $this->hasMany(Image::class, 'color_id', 'id')->where('active', 1)->limit(1);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id')->where('active', 1);
    }


    public function productNew(){
        $date_start = Carbon::now()->startOfMonth()->subMonth(3);
        $date_end = Carbon::now()->startOfMonth();
        return $this->belongsTo(Product::class, 'product_id', 'id')->where('active', 1)->whereBetween('release_date', [$date_start, $date_end]);
    }

    public function price(){
        return $this->hasMany(Price::class, 'color_id', 'id')->where('expire_date', null)->where('active',1);
    }
}
