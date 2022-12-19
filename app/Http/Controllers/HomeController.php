<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

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
    public function index(Request $request)
    {
        if ($request->cookie("loginID" . Auth::user()->id)) {
            return view('home', ['loginInfo' => Lang::get('public.welcome-again')]);
        } else {
            $response = new Response(view('home', ['loginInfo' => Lang::get('public.welcome')]));
            $response->withCookie(cookie()->forever("loginID" . Auth::user()->id, 'value' . Auth::user()->id));
            return $response;
        }
    }
}
