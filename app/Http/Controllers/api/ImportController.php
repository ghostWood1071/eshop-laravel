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
use App\Models\Scopes\ImportHelper;
class ImportController extends Controller
{
    
    public function index()
    {
        return Import::where('active', 1)->with('user')->orderBy('import_date', 'desc')->get();
    }
    
    public function store(Request $request)
    {
        $import = new Import;
        $id = Str::uuid()->toString();
        $import->id = $id;
        $import->import_date = Carbon::parse($request->import_date)->format('Y-m-d');
        $import->user_id = $request->user_id;
        $import->total_price = $request->total_price;
        $import->active = 1;
        $import->save();

        $details = array();
        foreach($request->details as $d){
            $detail = new ImportDetail;
            $detail->id = Str::uuid()->toString();
            $detail->import_id = $id;
            $detail->quantity = $d['quantity'];
            $detail->unit_price = $d['import_price']*$d['quantity'];
            $detail->color_id = $d['color_id'];
            $detail->size_id = $d['size'];
            $detail->active = 1;

            $price = Price::where('color_id', $d['color_id'])->where('expire_date', null)->first();
            if($price != null){
                $price->expire_date = Carbon::now();
                $price->save();
            }
            
            $price = new Price;
            $price->id = Str::uuid()->toString();
            $price->color_id = $d['color_id'];
            $price->sold_value = $d['sold_price'];
            $price->import_value = $d['import_price'];
            $price->start_date = Carbon::now();
            $price->import_detail_id = $detail->id;
            $price->active = 1;
            $price->save();

            $detail->save();
            array_push($details, $detail);
        }

        foreach($details as $d){
            $size = Size::where('id', $d->size_id)->where('color_id', $d->color_id)->first();
            if($size == null){
                $size = new Size;
                $size->id = $d->size_id;
                $size->color_id = $d->color_id;
                $size->value = $d->size_id;
                $size->active = 1;
                $size->quantity = 0;
            }
            $size->quantity+= $d->quantity;
            $size->save();
        }

        return $import->with('user')->get()[0];
    }
    
    public function update(Request $request, $id)
    {
        $import = Import::find($id);
        $import->import_date = Carbon::parse($request->import_date)->format('Y-m-d');
        $import->user_id = $request->user_id;
        $import->total_price = $request->total_price;
        $import->save();
        
        foreach($request->details as $d){
            if(array_key_exists('state', $d)){
                if($d['state'] == 0){
                    ImportHelper::updateImportDetail($d);
                } else if ($d['state'] == 1){
                    ImportHelper::createImportDetail($d, $id);
                } else {
                    ImportHelper::deleteDetail($d);
                }
            }
        }
        return $import->with('user')->get()[0];
    }

    public function destroy($id)
    {
        $import = Import::find($id);
        $import->active=0;
        $import->save();
        return $import;
    }
}
