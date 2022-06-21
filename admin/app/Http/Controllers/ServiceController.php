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
}
