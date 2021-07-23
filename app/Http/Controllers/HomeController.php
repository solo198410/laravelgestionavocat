<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Avocat, App\Skill, App\Detail, App\Typedetail, App\Wilaya;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(Request $request)
    {
        if ($request->input('title') != '' || $request->input('wilaya_id') != ''){
            $listavocat = Avocat::where([
                ['title', 'like', '%'.$request->input("title").'%'],
                ['wilaya_id', 'like', '%'.$request->input("wilaya_id").'%'],
                ])->get();
        }
        else {
            $listavocat = Avocat::all();
        }
        return view('INTERNAUTE.accueil', ['listavocat' => $listavocat]);
        }
        
        public function detail($id)
    {
            $avocat = Avocat::find($id);
        return view('INTERNAUTE.show', ['avocat' => $avocat]);
        }
}
