<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use App\Traits\Helpers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Helpers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      return $this->home_content();
    }

}

