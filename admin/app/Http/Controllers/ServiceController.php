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

    function GetServiceDetails(Request $request){

        $id = $request->input('id');
        $result = ServicesModel::where('id','=',$id)->get();
        return $result;
    }

    function ServiceAdd(Request $req){

        $name= $req->input('name');
        $des= $req->input('des');
        $img= $req->input('img');
        $result= ServicesModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);

        if($result==true){      
           return 1;
        }
        else{
           return 0;
        }
    }

    function ServiceUpdate(Request $req){
        $id= $req->input('id');
        $name= $req->input('name');
        $des= $req->input('des');
        $img= $req->input('img');

    
        // $result = ServicesModel::whereId($id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);

        // //var_dump($result);
        // if($result){      
        //    return 1;
        // }
        // else{
        //    return 0;
        // }

        $serviceModel = ServicesModel::find($id);
        $serviceModel->service_name = $name;
        $serviceModel->service_des = $des;
        $serviceModel->service_img = $img;

        $result = $serviceModel->save(); 
             
        if($result==true){      
           return 1;
        }
        else{
           return 0;
        }
               
    }

    function ServiceDelete(Request $request){
        //dump($request);
        $id = $request->input('id');
        $result = ServicesModel::where('id','=',$id)->delete();

        if($result == true) return 1;
        else return 0;  
    }
}
