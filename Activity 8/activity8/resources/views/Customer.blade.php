@extends('master')

@section('content')

    <div
        style="display:flex; flex-direction: column; align-items: center;">
        <h2>Customer</h2>
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
            <label style="font-weight: bold;" for="">Address:</label><br>
            <input type="text" readonly value="{{$addr}}">
        </div>
    </div>
@endsection