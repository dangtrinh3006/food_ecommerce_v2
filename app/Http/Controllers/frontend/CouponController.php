<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use PHPUnit\Framework\Constraint\Count;
use App\Http\Controllers\frontend\CouponController;

class CouponController extends Controller
{
    //APIs for categories
    function getCoupons()
    {
        return Coupon::all();
    }

    function getCouponByID($id)
   {
       return Coupon::find($id);
   }

   function addCoupon(Request $req)
   {
       $coupon = new Coupon;
       
       $coupon->ten=$req->ten;
       $coupon->hinhanh=$req->hinhanh;
       $coupon->code=$req->code;
       $coupon->mota=$req->mota;
       $coupon->ngaybd=$req->ngaybd;
       $coupon->ngaykt=$req->ngaykt;
       $coupon->giamgia=$req->giamgia;
       $coupon->dieukien=$req->dieukien;
       $coupon->loaigiam=$req->loaigiam;
       $coupon->hienthi=$req->hienthi;
       $coupon->trangthai=$req->trangthai;

       
       $result=$coupon->save();
       if($result){
           return ["Result"=>"Data has been saved"];
       }else{
           return ["Result"=>"Operation failed"];
       }
   }

   function updateCouponAPI(Request $req){
       $coupon = Coupon::find($req->id);

       $coupon->ten=$req->ten;
       $coupon->hinhanh=$req->hinhanh;
       $coupon->code=$req->code;
       $coupon->mota=$req->mota;
       $coupon->ngaybd=$req->ngaybd;
       $coupon->ngaykt=$req->ngaykt;
       $coupon->giamgia=$req->giamgia;
       $coupon->dieukien=$req->dieukien;
       $coupon->loaigiam=$req->loaigiam;
       $coupon->hienthi=$req->hienthi;
       $coupon->trangthai=$req->trangthai;
       
       $result=$coupon->save();


       if($result){
           return ["Result"=>"Data has been updated"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   function deleteCouponAPI($id){
       $coupon = Coupon::find($id);
       $result = $coupon->delete();

       if($result){
           return ["Result"=>"Data has been deleted"];
       }else{
           return ["Result"=>"Operation failed"];
       }    
   }

   
    function getCoupon()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $coupon = Coupon::where('trangthai', 1)
            ->where('hienthi', 1)
            ->where('ngaykt', '>', $today)
            ->where('dieukien', '!=', 1)
            ->get();

        return response()->json($coupon);
    }

    function checkCoupon(Request $request)
    {
        $id = ($request->id);
        $code = ($request->code);
        $coupon = null;
        if ($id) {
            $coupon = Coupon::find($id);
        }
        if ($code) {
            $coupon = Coupon::where('code', $code)->first();
        }
        if ($coupon) {
            $couponSS = Session('coupon') ? Session('coupon') : null;
            if ($couponSS) {
                $request->session()->forget('coupon');
                $request->session()->put('coupon', $coupon);
            } else {
                $request->session()->put('coupon', $coupon);
            }

            $html = view('templates.clients.home.cart')->render();
            return Response()->json(['coupon' => $coupon, 'html' => $html]);
        } else {
            return Response()->json('Mã giảm giá không tồn tại');
        }
    }

    public function getAllPromotion()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $promotion = Coupon::where('trangthai', 1)
            ->where('hienthi', 1)
            ->where('ngaykt', '>', $today)
            ->get();
        $viewData = [
            'promo' => $promotion
        ];
        return view('templates.clients.promotion.index', $viewData);
    }
}