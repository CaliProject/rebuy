<?php

namespace Rebuy\Http\Controllers;

use Illuminate\Http\Request;

use Rebuy\Http\Requests;

class MarketsController extends Controller
{

    public function index()
    {
        return view('markets');
    }
}
