<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    //APIs for districts
    function getDistricts()
    {
        return District::all();
    }

    function getDistrictByID($id)
   {
       return District::find($id);
   }
   
   function addDistrict(Request $req)
   {
       $district = new District;
       
       $district->district_code=$req->district_code;
       $district->district_name=$req->district_name;
       $district->district_type=$req->district_type;
       $district->province_code=$req->province_code;
       
       $result=$district->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateDistrictAPI(Request $req){
       $district = District::find($req->id);

       $district->id=$req->id;
       $district->district_code=$req->district_code;
       $district->district_name=$req->district_name;
       $district->district_type=$req->district_type;
       $district->province_code=$req->province_code;
       
       $result=$district->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteDistrictAPI($id){
       $district = District::find($id);
       $result = $district->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
