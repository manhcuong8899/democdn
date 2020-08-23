<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use VNPCMS\Products\Products;

class SeachController extends Controller
{


    public function fulltext(Request $request)
    {
        $seach = $request->seach;
        $listproducts = Products::orderBy('id','desc')
            ->where('name','LIKE','%'.$seach.'%')
            ->orwhere('size','LIKE','%'.$seach.'%')
            ->orwhere('color','LIKE','%'.$seach.'%')
            ->orwhere('price','LIKE','%'.$seach.'%')
            ->orwhere('short','LIKE','%'.$seach.'%')
            ->orwhere('long','LIKE','%'.$seach.'%')
            ->orwhere('model','LIKE','%'.$seach.'%')
            ->groupBy('name')->paginate(25);
        return view('themes.home.seach',compact('listproducts'));
    }

    public function seachfillter(Request $request)
    {

    }

}