<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    //APIs for users
    function getUsers()
    {
        $data = User::all();
        $payload = Crypt::encrypt($data);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $payload
        ],Response::HTTP_OK);
    }

    function getUserByID($id)
   {
        $data = User::find($id);
        $payload = Crypt::encrypt($data);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $payload
        ],Response::HTTP_OK);
   }

   function addUser(Request $req)
   {
       $user = new User;
       
       $user->email=$req->email;
       $user->email_verified_at=$req->email_verified_at;
       $user->password=$req->password;
       $user->level=$req->level;
       $user->remember_token=$req->remember_token;
       $user->name_staff=$req->name_staff;
       $user->roles_id=$req->roles_id;
       $user->page_access=$req->page_access;
       $user->type_account=$req->type_account;
       $user->phone_number=$req->phone_number;
       $user->status=$req->status;

       $result=$user->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateUserAPI(Request $req){
       $user = User::find($req->id);

       $user->email=$req->email;
       $user->email_verified_at=$req->email_verified_at;
       $user->password=$req->password;
       $user->level=$req->level;
       $user->remember_token=$req->remember_token;
       $user->name_staff=$req->name_staff;
       $user->roles_id=$req->roles_id;
       $user->page_access=$req->page_access;
       $user->type_account=$req->type_account;
       $user->phone_number=$req->phone_number;
       $user->status=$req->status;
       
       $result=$user->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteUserAPI($id){
       $user = User::find($id);
       $result = $user->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }
}
