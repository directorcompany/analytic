<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Jobs\UrlVerify;
class HomeController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'url'=>'required',
            'freq'=>'required',
            'count'=>'required'
        ]);
        $url = $request->url;
        $freq= $request->freq;
        $count = $request->count;
        Manager::create(['url'=>$url,'freq'=>$freq,'count'=>$count]);
        $id =  Manager::latest()->get()[0]->id;
        $result = Manager::find($id);
        dispatch(new UrlVerify($result))->delay(($result->freq)*60);


        return redirect()->route('home')->with('success','Успешно добавлено');
    }
}
