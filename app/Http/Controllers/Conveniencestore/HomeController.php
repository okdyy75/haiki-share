<?php

namespace App\Http\Controllers\Conveniencestore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:conveniencestore');
    }

    public function index()
    {
        return view('conveniencestore.home');
    }
}
