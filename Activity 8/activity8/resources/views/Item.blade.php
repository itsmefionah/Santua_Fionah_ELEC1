@extends('master')

@section('content')

    <div
        style="display:flex; flex-direction: column; align-items: center;">
        <h2>Item</h2>
        <div>
            <label style="font-weight: bold;" for="">Item No:</label><br>
            <input type="text" readonly value="{{$itemNo}}">
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
    </div>


@endsection