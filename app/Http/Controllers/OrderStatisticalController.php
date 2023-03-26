<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_statisticals;

class OrderStatisticalController extends Controller
{
    //APIs for order Statisticals
    function getOrderStatisticals()
    {
        return Order_statisticals::all();
    }

    function getOrderStatisticalByID($id)
   {
       return Order_statisticals::find($id);
   }

   function addOrderStatistical(Request $req)
   {
       $orderStatistical = new Order_statisticals;
       
       $orderStatistical->id_san_pham_order=$req->id_san_pham_order;
       $orderStatistical->so_luot_dat=$req->so_luot_dat;
       $orderStatistical->trang_thai=$req->trang_thai;

       $result=$orderStatistical->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateOrderStatisticalAPI(Request $req){
       $orderStatistical = Order_statisticals::find($req->id);

       $orderStatistical->id_san_pham_order=$req->id_san_pham_order;
       $orderStatistical->so_luot_dat=$req->so_luot_dat;
       $orderStatistical->trang_thai=$req->trang_thai;

       
       $result =$orderStatistical->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteOrderStatisticalAPI($id){
       $orderStatistical = Order_statisticals::find($id);
       $result = $orderStatistical->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
