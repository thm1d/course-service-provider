<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function VisitorIndex(){

        $VisitorData = json_decode(VisitorModel::orderBy('id','DESC')->get(), true);

        //dd($VisitorData);

        return view('visitor', [
                'VisitorData' => $VisitorData,
        ]);
    }
}
