<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ward;

class WardController extends Controller
{
    //APIs for wards
    function getWards()
    {
        return Ward::all();
    }

    function getWardByID($id)
   {
       return Ward::find($id);
   }

   function addWard(Request $req)
   {
       $ward = new Ward;
       
       $ward->district_code=$req->district_code;
       $ward->ward_code=$req->ward_code;
       $ward->ward_name=$req->ward_name;
       $ward->ward_type=$req->ward_type;
       

       $result=$ward->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateWardAPI(Request $req){
       $ward = Ward::find($req->id);

       $ward->district_code=$req->district_code;
       $ward->ward_code=$req->ward_code;
       $ward->ward_name=$req->ward_name;
       $ward->ward_type=$req->ward_type;
       
       $result=$ward->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteWardAPI($id){
       $ward = Ward::find($id);
       $result = $ward->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
