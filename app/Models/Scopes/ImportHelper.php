<?php
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Storage;
use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Size;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ImportHelper implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        //
    }

    public static function createImportDetail($d, $id){
        $detail = new ImportDetail;
        $detail->id = Str::uuid()->toString();
        $detail->import_id = $id;
        $detail->quantity = $d['quantity'];
        $detail->unit_price = $d['import_price']*$d['quantity'];
        $detail->color_id = $d['color_id'];
        $detail->size_id = $d['size'];
        $detail->active = 1;
        $detail->save();

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

        $size = Size::where('id', $d['size'])->where('color_id', $d['color_id'])->first();
        if($size == null){
            $size = new Size;
            $size->id = $d['size'];
            $size->color_id = $d['color_id'];
            $size->value = $d['size'];
            $size->active = 1;
            $size->quantity = 0;
        }
        $size->quantity+= $d['quantity'];
        $size->save();
    }

    public static function updateImportDetail($d){
        $detail = ImportDetail::find($d['id']);
        
        $detail->unit_price = $d['import_price']*$d['quantity'];
        $detail->color_id = $d['color_id'];
        $detail->size_id = $d['size'];
        

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

        $size = Size::where('id', $d['size'])->where('color_id', $d['color_id'])->first();
        $size->quantity-= ($detail->quantity - $d['quantity']);
        $size->save();

        $detail->quantity = $d['quantity'];
        $detail->save();
    }

    public static function deleteDetail($d){
        $detail = ImportDetail::find($d['id']);
        $detail->active = 0;
        $detail->save();
    }
    
}

