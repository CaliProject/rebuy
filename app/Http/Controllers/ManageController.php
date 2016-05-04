<?php

namespace Rebuy\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller {

    /**
     * Show index page.
     * 
     * @return mixed
     */
    public function index()
    {
        return view('manage.index');
    }
}
