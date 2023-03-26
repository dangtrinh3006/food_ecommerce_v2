<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    //APIs for provinces
    function getProvinces()
    {
        return Province::all();
    }

    function getProvinceByID($id)
   {
       return Province::find($id);
   }

   function addProvince(Request $req)
   {
       $province = new Province;
       
       $province->province_code=$req->province_code;
       $province->province_name=$req->province_name;
       $province->province_type=$req->province_type;

       $result=$province->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateProvinceAPI(Request $req){
       $province = Province::find($req->id);

       $province->province_code=$req->province_code;
       $province->province_name=$req->province_name;
       $province->province_type=$req->province_type;
       
       $result=$province->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteProvinceAPI($id){
       $province = Province::find($id);
       $result = $province->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
