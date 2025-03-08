<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function Customer($cusId, $name, $addr)
    {
        return view('Customer', compact('cusId', 'name', 'addr'));
    }

    public function Item($itemNo, $name, $price)
    {
        return view('Item', compact('itemNo', 'name', 'price'));
    }

    public function Order($cusId, $name, $orderNo, $date)
    {
        return view('Order', compact('cusId', 'name', 'orderNo', 'date'));
    }

    public function OrderDetails($transNo, $orderNo, $itemId, $name, $price, $qty)
    {
        return view('OrderDetails', compact('transNo', 'orderNo', 'itemId', 'name', 'price', 'qty'));
    }
}
