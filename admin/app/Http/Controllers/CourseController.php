<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;

class CourseController extends Controller
{
    function CourseIndex(){

        return view('courses');
    }

    function GetCoursesData(){
        $result = json_encode(CourseModel::orderBy('id', 'desc')->get());
        return $result;
    }

    function GetCourseDetails(Request $request){

        $id = $request->input('id');
        $result = CourseModel::where('id','=',$id)->get();
        return $result;
    }

    function CourseAdd(Request $req){

        $course_name= $req->input('name');
        $course_des= $req->input('des');
        $course_fee= $req->input('fee');
        $course_totalenroll= $req->input('enroll');
        $course_totalclass= $req->input('class');
        $course_link= $req->input('link');
        $course_img= $req->input('img');

        $result= CourseModel::insert([
            'course_name'=>$course_name,
            'course_des'=>$course_des,
            'course_fee'=>$course_fee,
            'course_totalenroll'=>$course_totalenroll,
            'course_totalclass'=>$course_totalclass,
            'course_link'=>$course_link,
            'course_img'=>$course_img
        ]);

        if($result==true){      
           return 1;
        }
        else{
           return 0;
        }
    }

    function CourseUpdate(Request $req){
        $id= $req->input('id');
        $course_name= $req->input('name');
        $course_des= $req->input('des');
        $course_fee= $req->input('fee');
        $course_totalenroll= $req->input('enroll');
        $course_totalclass= $req->input('class');
        $course_link= $req->input('link');
        $course_img= $req->input('img');

    
        // $result = CourseModel::whereId($id)->update([
        //     'course_name'=>$course_name,
        //     'course_des'=>$course_des,
        //     'course_fee'=>$course_fee,
        //     'course_totalenroll'=>$course_totalenroll,
        //     'course_totalclass'=>$course_totalclass,
        //     'course_link'=>$course_link,
        //     'course_img'=>$course_img
        // ]);

        
        // if($result){      
        //    return 1;
        // }
        // else{
        //    return 0;
        // }

        $courseModel = CourseModel::find($id);
        $courseModel->course_name = $course_name;
        $courseModel->course_des = $course_des;
        $courseModel->course_fee = $course_fee;
        $courseModel->course_totalenroll = $course_totalenroll;
        $courseModel->course_totalclass = $course_totalclass;
        $courseModel->course_link = $course_link;
        $courseModel->course_img = $course_img;

        $result = $courseModel->save(); 
             
        if($result){      
           return 1;
        }
        else{
           return 0;
        }
               
    }

    function CourseDelete(Request $request){
        //dump($request);
        $id = $request->input('id');
        $result = CourseModel::where('id','=',$id)->delete();

        if($result == true) return 1;
        else return 0;  
    }
}
