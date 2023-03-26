<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    //APIs for payments
    function getPayments()
    {
        return Payment::all();
    }

    function getPaymentByID($id)
   {
       return Payment::find($id);
   }

   function deletePaymentAPI($id){
       $payment = Payment::find($id);
       $result = $payment->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
