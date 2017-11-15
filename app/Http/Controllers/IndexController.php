<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $cssFile = url('assets/css/style.css');

        return view('upload-csv', ['cssFile' => $cssFile]);
    }
}
