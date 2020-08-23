<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use VNPCMS\Article\Articles;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
      /*  $this->middleware('role:administrator');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Totaluser = User::all()->count();
        $Totalnews = Articles::where('group','news')->count();
        $Totalservices = Articles::where('group','services')->count();
        $Totalproducts = Articles::where('group','news')->count();
        return view('dashboard',compact('Totaluser','Totalnews','Totalservices','Totalproducts'));
    }
}
