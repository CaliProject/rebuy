<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }
}
