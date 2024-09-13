<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class EsPrimoController extends Controller
{
    public function esPrimo(Request $request)
    {
        for ($num = 100; $num >= 1; $num--) {
            if ($this->es_primo($num)) {
                echo $num . PHP_EOL;
            }
        } 

    }

    private function  es_primo($num){
        if ($num < 2) {
            return false;
        }
        for ($i = 2; $i < $num; $i++) {  // Itera desde 2 hasta num-1
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }
}