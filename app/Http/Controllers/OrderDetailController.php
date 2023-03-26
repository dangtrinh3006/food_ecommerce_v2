<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetails;

class OrderDetailController extends Controller
{
    //APIs for order details
    function getOrderDetails()
    {
        return OrderDetails::all();
    }

    function getOrderDetailByID($id)
   {
       return OrderDetails::find($id);
   }

   function addOrderDetail(Request $req)
   {
       $orderDetail = new OrderDetails;
       
       $orderDetail->id_donhang=$req->id_donhang;
       $orderDetail->id_sanpham=$req->id_sanpham;
       $orderDetail->id_size=$req->id_size;
       $orderDetail->soluong=$req->soluong;
       $orderDetail->giaban=$req->giaban;
       $orderDetail->giagoc=$req->giagoc;

       $result=$orderDetail->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateOrderDetailAPI(Request $req){
       $orderDetail = OrderDetails::find($req->id);

       $orderDetail->id_donhang=$req->id_donhang;
       $orderDetail->id_sanpham=$req->id_sanpham;
       $orderDetail->id_size=$req->id_size;
       $orderDetail->soluong=$req->soluong;
       $orderDetail->giaban=$req->giaban;
       $orderDetail->giagoc=$req->giagoc;

       
       $result =$orderDetail->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteOrderDetailAPI($id){
       $orderDetail = OrderDetails::find($id);
       $result = $orderDetail->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
