<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Show the index page.
     *
     * @return View
     */
    public function __invoke()
    {
        return view('index');
    }
}
