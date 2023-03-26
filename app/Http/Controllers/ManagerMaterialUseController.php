<?php

namespace App\Http\Controllers;

use App\Models\ManagerMaterialUse;
use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ManagerMaterialUseController extends Controller
{
    public function index()
    {
        $managerM = ManagerMaterialUse::paginate(20);
        $nameM = Materials::all();
        return view('admin_pages.managerMaterialUse.index', compact('managerM', 'nameM'));
    }

    public function sortMalByDay(Request $req)
    {
        $date = date_create($req->dateSort);
        $date_f = date_format($date, "Y-d-m");
        echo $req->dateSorto;
        // $managerM = ManagerMaterialUse::where('ngay_tong_ket', $req->dateSort);
        // $nameM = Materials::all();
        // return view('admin_pages.managerMaterialUse.index', compact('managerM', 'nameM'));
    }
    public function delMMU($id)
    {
        $getRecord = ManagerMaterialUse::find($id);
        $getRecord->delete();
        session()->put('delete_success', 'xoa thanh cong');
        return redirect()->back();
    }
    ///add new
    public function add()
    {
        $materials = Materials::all();
        return view('admin_pages.managerMaterialUse.add', compact('materials'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'soluong' => 'required|integer|min:0'
        ]);

        $newmmu = new ManagerMaterialUse();
        $slug_name = Str::slug($request->namemmu);

        $newmmu->so_luong = $request->soluong;
        $timenow = Carbon::now('asia/Ho_Chi_Minh')->toDateString();
        $newmmu->ngay_tong_ket = $timenow;

        $getmmu = Materials::where('id', $request->materials)->first();

        $getData = Materials::where('id', $request->materials)->get();
        if ($getData->count() == 0) {
            session()->put('errors_add', 'nguyên liệu không tồn tại');
            return view('admin_pages.managerMaterialUse.add');
        } else {
            $newmmu->don_gia = $getmmu->gia_nhap;
            $newmmu->id_nguyen_lieu = $getmmu->id;
            session()->forget('add_mmu');
            //update quality material
            $qualityCurrent =  $getmmu->so_luong;
            if ($qualityCurrent < $request->soluong) {
                
                return redirect()->back()->with('failStatus', 'Số lượng sử dụng lớn hơn số lượng trong kho.');
            }
            if ($this->checknameExists($getmmu->id)) {

                return redirect()->back()->with('failStatus', 'Tên nguyên liệu đã được khởi tạo.');
            }

            $newQuanty = $qualityCurrent - $request->soluong;
            $getmmu->so_luong = $newQuanty;
            $getmmu->save();
            $newmmu->save();
            $managerM = ManagerMaterialUse::paginate(20);
            $nameM = Materials::all();
        }


        return view('admin_pages.managerMaterialUse.index', compact('managerM', 'nameM'));
    }

    //edit
    public function edit($id)
    {
        $getmmu = ManagerMaterialUse::where('id', $id)->first();
        $getnameMal = Materials::where('id', $getmmu->id_nguyen_lieu)->first();
        $namemal = $getnameMal->ten_nglieu;
        return view('admin_pages.managerMaterialUse.edit', compact('getmmu', 'namemal'));
    }
    public function update($id, Request $request)
    {
        $updatemmu = ManagerMaterialUse::where('id', $id)->first();
        $getnamemal = Materials::where('ten_nglieu', $request->namemmu)->first();
        $mal = Materials::where('id', $updatemmu->id_nguyen_lieu)->first();

        $slug_mal = Str::slug($request->namemmu);
        // $updatemmu ->slug_name_mal=$slug_mal;
        if ($getnamemal == null) {
            session()->put('errors_add', 'Tên nguyên liệu không tồn tại');
            return redirect()->back()->with('failStatus', 'Tên nguyên liệu không tồn tại.');
        }
        if ($request->quantymmu > $updatemmu->so_luong ) {
            $soluongtang = $request->quantymmu - $updatemmu->so_luong;
            if ($mal->so_luong < $soluongtang ) {
                return redirect()->back()->with('failStatus', 'Số lượng trong kho không đủ để cập nhật.');
            } else {
                $mal->so_luong = $mal->so_luong - $soluongtang;
                $updatemmu->so_luong = $request->quantymmu;
            }
        } else if ($request->quantymmu <= $updatemmu->so_luong ) {
            return redirect()->back()->with('failStatus', 'Số lượng cập nhật phải lớn hơn ban đầu.');
        }
        // if($this->checknameExists($request->namemmu)){
        //     return view('admin_pages.managerMaterialUse.add')->with('loi_ten_ton_tai','nguyên liệu này đã có trong bảng');
        // }
        $mal->save();
        $updatemmu->save();
        $managerM = ManagerMaterialUse::paginate(20);
        $nameM = Materials::all();
        session()->put('update_success', 'Thanh conng');

        return view('admin_pages.managerMaterialUse.index', compact('managerM', 'nameM'));
    }


    function checknameExists($id)
    {

        $getData = ManagerMaterialUse::where('id_nguyen_lieu', $id)->get();
        if ($getData->count() > 0) {
            return true;
        }
        return false;
    }
    function checkNameMal($name)
    {
        $getDT = Materials::where('ten_nglieu', $name)->get();
        if ($getDT->count() > 0) {
            return true;
        }
        return false;
    }

    public function turnover(Request $req)
    {
        $tienThu = 0;
        $date = date_create($req->datethongke);
        $date_f = date_format($date, "Y-d-m");
        $getDT = ManagerMaterialUse::where('ngay_tong_ket', $date_f)->get();
        $tienvatlieu = 0;
        foreach ($getDT as $val) {
            $tienvatlieu += $val->so_luong * $val->don_gia;
        }
        return $tienvatlieu;
    }
    public function searchmal(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = DB::table('materials')->where('ten_nglieu', 'LIKE', '%' . $request->search . '%')->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<h4><button id="choosenamemal type="button">' . $product->ten_nglieu . '</button></h4>';
                }
            }

            return Response($output);
        }
    }
}