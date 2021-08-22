<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('laranews-admin');
    }
    public function logout(){
     Auth::logout();
     return redirect('laranews-admin');
    }
}
