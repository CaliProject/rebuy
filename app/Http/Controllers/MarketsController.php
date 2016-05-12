<?php

namespace Rebuy\Http\Controllers;

use Illuminate\Http\Request;

class MarketsController extends Controller
{

    public function index()
    {
        return view('markets');
    }
}
