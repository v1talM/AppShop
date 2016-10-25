<?php

namespace App\Http\Controllers;

use App\Repositories\HomeApiRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $repository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeApiRepository $repository)
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

}
