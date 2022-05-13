<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $order = new Order;
        $id = Str::uuid()->toString();
        $order->id = $id;
        $order->user_id = $request->user_id;
        $order->total_price = $request->total_price;
        $order->payment = $request->payment;
        $order->address = $request->address;
        $order->order_date = Carbon::parse($request->import_date)->format('Y-m-d');
        $order->active=1;
        $order->save();

        foreach($request->details as $detail){
            $new_detail = new OrderDetail;
            $product = Size::where('active',1)->where('color_id', $detail['color_id'])->where('id', $detail['size_id'])->first();
            $product->quantity-=1;
            $product->save();
            $new_detail->id = Str::uuid()->toString();
            $new_detail->order_id = $id;
            $new_detail->color_id = $detail['color_id'];
            $new_detail->size_id = $detail['size_id'];
            $new_detail->quantity = $detail['quantity'];
            $new_detail->discount = $detail['discount'];
            $new_detail->unit_price = (1-$detail['discount'])*$detail['quantity']*$detail['price'];
            $new_detail->active=1;
            $new_detail->save();
        }
        return $request;
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
