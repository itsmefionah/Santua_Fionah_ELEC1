<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function home(){
        $users = DB::select("select * from users ");
        return view('dashboard',compact('users'));
    }
}
