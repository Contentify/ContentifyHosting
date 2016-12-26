<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    /**
     * Show the application backend dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Admin';
    }
}
