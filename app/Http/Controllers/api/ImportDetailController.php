<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Size;
use App\Models\Price;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ImportDetailController extends Controller
{
    
    public function index()
    {
        return ImportDetail::where('active', 1)->get();
    }
    
    public function show($id)
    {
        return DB::select('CALL get_import_details(?)',array($id));
    }
}
