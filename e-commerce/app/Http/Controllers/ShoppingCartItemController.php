<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartItemController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
