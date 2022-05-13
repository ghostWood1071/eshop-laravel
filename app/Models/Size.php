<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "size";

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
