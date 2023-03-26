<?php
namespace App\Http\Controllers;
use App\Models\MaterialUnit;
use Illuminate\Http\Request;

class MaterialUnitController extends Controller
{
    //APIs for MaterialUnits
    function getMaterialUnits()
    {
        return MaterialUnit::all();
    }

    function getMaterialUnitByID($id)
   {
       return MaterialUnit::find($id);
   }
   
   function addMaterialUnit(Request $req)
   {
       $materialUnit = new MaterialUnit;
       
       $materialUnit->ten_don_vi=$req->ten_don_vi;
       $materialUnit->trang_thai=$req->trang_thai;

       
       $result=$materialUnit->save();

       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateMaterialUnitAPI(Request $req){
       $materialUnit = MaterialUnit::find($req->id);

       $materialUnit->ten_don_vi=$req->ten_don_vi;
       $materialUnit->trang_thai=$req->trang_thai;
       
       $result=$materialUnit->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteMaterialUnitAPI($id){
       $materialUnit = MaterialUnit::find($id);
       $result = $materialUnit->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }


    public function show()
    {
        $don_vi = MaterialUnit::all();

        return view('admin_pages.materialUnit.index',compact('don_vi'));
    }
}
