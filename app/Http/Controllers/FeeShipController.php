<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\FeeShip;

class FeeShipController extends Controller
{
    //APIs for feeship
    function getFeeShips()
    {
        return FeeShip::all();
    }

    function getFeeShipByID($id)
   {
       return FeeShip::find($id);
   }
   
   function addFeeShip(Request $req)
   {
       $feeship = new FeeShip;
       
       $feeship->province_id=$req->province_id;
       $feeship->district_id=$req->district_id;
       $feeship->ward_id=$req->ward_id;
       $feeship->feeship=$req->feeship; 
       $feeship->trangthai=$req->trangthai;
       $feeship->parent=$req->parent;
       
       $result=$feeship->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateFeeShipAPI(Request $req){
       $feeship = FeeShip::find($req->id);

       $feeship->province_id=$req->province_id;
       $feeship->district_id=$req->district_id;
       $feeship->ward_id=$req->ward_id;
       $feeship->feeship=$req->feeship; 
       $feeship->trangthai=$req->trangthai;
       $feeship->parent=$req->parent;
       
       $result=$feeship->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deletefeeShipAPI($id){
       $feeship = FeeShip::find($id);
       $result = $feeship->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
