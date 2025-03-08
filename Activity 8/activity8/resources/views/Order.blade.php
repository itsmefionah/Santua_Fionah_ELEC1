@extends('master')
@section('content')
    <div
        style="display:flex; flex-direction: column; align-items: center;">
        <h2>Order</h2>
        <div>
            <label style="font-weight: bold;" for="">Customer ID:</label><br>
            <input type="text" readonly value="{{$cusId}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Name:</label><br>
            <input type="text" readonly value="{{$name}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Order No:</label><br>
            <input type="text" readonly value="{{$orderNo}}">
        </div>
        <br>
        <div>
            <label style="font-weight: bold;" for="">Date:</label><br>
            <input type="text" readonly value="{{$date}}">
        </div>
    </div>
@endsection