<?php

namespace Rebuy\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller {

    /**
     * Show section index page.
     *
     * @param $section
     * @return mixed
     */
    public function index($section = null)
    {
        if (is_null($section))
            return view('manage.index');

        $view = "manage.{$section}.index";

        if (! view()->exists($view))
            abort(404);

        return view($view);
    }
}
