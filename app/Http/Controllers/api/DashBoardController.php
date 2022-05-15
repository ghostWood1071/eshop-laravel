<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashBoardController extends Controller
{
    public function getYearProfit($n){
        return DB::select('CALL analyst_year_profit(?)',array($n));
    }

    public function getLoyalCustomer($n){
        return DB::select('CALL get_loyal_customer(?)',array($n));
    }

    public function getMonhtProfit($n){
        return DB::select('CALL analyst_month_profit(?)',array($n));
    }
}
