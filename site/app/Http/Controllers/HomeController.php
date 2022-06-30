<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;

class HomeController extends Controller
{
    function HomeIndex(){

        // Ip Get
        $UserIP=$_SERVER['REMOTE_ADDR'];


        // Date Time
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$UserIP, 'visit_time'=>$timeDate]);

        $servicesData = json_decode(ServicesModel::all(), true);

        $coursesData = json_decode(CourseModel::orderBy('id', 'desc')->limit(6)->get(), true);

        return view('home', [
            'serviceData' => $servicesData,
            'coursesData' => $coursesData,
        ]);
    }
}
