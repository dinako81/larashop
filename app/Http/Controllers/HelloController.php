<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HelloController extends Controller
{
    public function hello()
    {
        return '<h1 style="color:skyblue;">Hello client</h1>';
    }
}