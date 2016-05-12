<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Product;
use Illuminate\Http\Request;

class MarketsController extends Controller
{

    public function index()
    {
        return view('markets');
    }

    public function show(Product $product)
    {
        return $product;
    }
}
