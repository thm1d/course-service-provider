<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServiceController extends Controller
{
    function ServiceIndex(){


        return view('services');
    }

    function GetServiceData(){
        $result = json_encode(ServicesModel::all());
        return $result;
    }

    function ServiceDelete(Request $request){
        dump($request);
        $id = $request->input('id');
        $result = ServicesModel::where('id','=',$id)->delete();

        if($result == true) return 1;
        else return 0;  
    }
}
