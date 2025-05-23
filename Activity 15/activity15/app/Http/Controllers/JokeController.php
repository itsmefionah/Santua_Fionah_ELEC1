<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JokeController extends Controller
{
    //
      public function index()
    {
        //
        $joke = Http::get("https://sv443.net/jokeapi/v2/joke/Any");
        return view('apiView', compact('joke'));
    }
}
