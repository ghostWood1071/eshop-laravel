<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderDetailController extends Controller
{
    
    public function show($id)
    {
        return DB::select('CALL get_order_details(?)',array($id));
    }

}
