<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function breakdown($money)
    {
    $OrigMoney = $money; 
    $moneyToWord = $money; 
    $word = "";

    $list = [1000, 500, 200, 100, 50, 20, 5, 1];

    $breakdown = [];

    if ($money >= 1000) {
        $breakdown[1000] = (int) ($money / 1000);
        $money = $money % 1000;
    } else {
        $breakdown[1000] = 0;
    }
    
    if ($money >= 500) {
        $breakdown[500] = (int) ($money / 500);
        $money = $money % 500;
    } else {
        $breakdown[500] = 0;
    }
    
    if ($money >= 200) {
        $breakdown[200] = (int) ($money / 200);
        $money = $money % 200;
    } else {
        $breakdown[200] = 0;
    }
    
    if ($money >= 100) {
        $breakdown[100] = (int) ($money / 100);
        $money = $money % 100;
    } else {
        $breakdown[100] = 0;
    }
    
    if ($money >= 50) {
        $breakdown[50] = (int) ($money / 50);
        $money = $money % 50;
    } else {
        $breakdown[50] = 0;
    }
    
    if ($money >= 20) {
        $breakdown[20] = (int) ($money / 20);
        $money = $money % 20;
    } else {
        $breakdown[20] = 0;
    }
    
    if ($money >= 5) {
        $breakdown[5] = (int) ($money / 5);
        $money = $money % 5;
    } else {
        $breakdown[5] = 0;
    }
    
    if ($money >= 1) {
        $breakdown[1] = (int) ($money / 1);
    } else {
        $breakdown[1] = 0;
    }
    

    $ConvertWord = [
        0 => "", 1 => "one", 2 => "two", 3 => "three", 4 => "four", 5 => "five",
        6 => "six", 7 => "seven", 8 => "eight", 9 => "nine", 10 => "ten",
        11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen",
        15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen",
        19 => "nineteen", 20 => "twenty", 30 => "thirty", 40 => "forty",
        50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eighty", 90 => "ninety"
    ];

    if ($moneyToWord == 0) {
        $word = "zero";
    } else {
        if ($moneyToWord >= 1000) {
            $thousands = $moneyToWord / 1000;
            $moneyToWord = $moneyToWord % 1000;
            $word .= $ConvertWord[$thousands] . " thousand ";
        }

        if ($moneyToWord >= 100) {
            $hundreds = $moneyToWord / 100;
            $moneyToWord = $moneyToWord % 100;
            $word .= $ConvertWord[$hundreds] . " hundred ";
        }

        if ($moneyToWord > 19) {
            $tens = (int)($moneyToWord / 10) * 10;
            $units = $moneyToWord % 10;
            $word .= $ConvertWord[$tens] . " " . $ConvertWord[$units];
        } else {
            $word .= $ConvertWord[$moneyToWord];
        }
    }

    $word = trim($word);

    $color = ($OrigMoney % 2 == 0) ? 'red' : 'green';

    return view('Money', compact('OrigMoney', 'word', 'color', 'breakdown'));
    }
}
