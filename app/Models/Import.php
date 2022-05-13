<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $table = 'imports';
    public $incrementing = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
