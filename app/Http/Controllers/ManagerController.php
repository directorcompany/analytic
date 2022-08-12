<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Check;
use App\Jobs\UrlVerify;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $urls = Manager::oldest()->paginate(10);
        // $exitCode = Artisan::call('queue:listen');
        return view('list.index',compact('urls'))
        ->with('i',(request()->input('page', 1) - 1)*10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id=null)
    {
        //
        if(isset($id)) {
            $id = Manager::find($id);
            dispatch(new UrlVerify($id))->delay(($id->freq)*60);
        }
        else {
        $all = Manager::get();
       foreach($all as $del) {
        dispatch(new UrlVerify($del))->delay(($del->freq)*60);
        }
    }
    return redirect()->route('manager')->with('success','Успешно проверено');
 
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $urls = Check::latest()->paginate(10);
        return view('list.check',compact('urls'))
        ->with('i',(request()->input('page', 1) - 1)*10);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function artisan()
    {
        //
        Artisan::call('queue:work');

    }
}