<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BackendController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application backend dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.home');
    }
}
