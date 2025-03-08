@extends('master')
@section('content')
    <div
        style="display:flex; flex-direction: column; align-items: center;">
        <h2>Order Details</h2>
        <div>
            <label style="font-weight: bold;" for="">Transaction No:</label><br>
            <input type="text" readonly value="{{$transNo}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Order No:</label><br>
            <input type="text" readonly value="{{$orderNo}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Item ID:</label><br>
            <input type="text" readonly value="{{$itemId}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Name:</label><br>
            <input type="text" readonly value="{{$name}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Price:</label><br>
            <input type="text" readonly value="{{$price}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Quantity:</label><br>
            <input type="text" readonly value="{{$qty}}">
        </div>
    </div>
@endsection