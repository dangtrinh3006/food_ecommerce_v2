<?php

namespace App\Http\Controllers;

use App\Models\ManagerStaff;
use App\Models\type_account;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RoleController extends Controller
{
    public function index()
    {
        $getID = auth()->user()->id;
        $getLogin = User::where('id', $getID)->get('page_access');
        // $listRoles = "";
        // foreach ($getLogin as $g) {
        //     $listRoles = $g['page_access'];
        // }
        // $pieces = explode(",", $listRoles);
        // $roles = array();
        $getStaff = User::all();
        // return view('admin_pages.managerpermission.index', compact('getStaff'));
        // foreach ($pieces as $p) {
        //     if ($p == 6) {
        //         $getStaff = User::all();
        //         return view('admin_pages.managerpermission.index', compact('getStaff'));
        //     }
        // }
        return view('admin_pages.managerpermission.index', compact('getStaff'));


        // return view('admin_pages.denyaccess.index');
    }

    public function addview()
    {

        // $getID = auth()->user()->id;
        // $getLogin = User::where('id', $getID)->get('roles_id');
        // $listRoles = "";
        // foreach ($getLogin as $g) {
        //     $listRoles = $g['roles_id'];
        // }
        // $pieces = explode(",", $listRoles);
        // $roles = array();
        // foreach ($pieces as $p) {
        //     if ($p == 4) {
        //         return view('admin_pages.managerpermission.add');
        //     }
        // }
        $type_accounts = type_account::all();

        return view('admin_pages.managerpermission.add', compact('type_accounts'));

    }

    public function addhandle(Request $request)
    {
        $type_accounts = type_account::all();

        //validate values input from form add
        $request->validate([
            'email' => 'required|email|max:255',
            'ten' => 'required|max:255',
            'matkhau' => 'required|min:6|max:15',
            'dienthoai' => 'required|max:10',
        ]);

        $newStaff = new User();
        $newStaff->email = $request->email;
        $newStaff->name_staff = $request->ten;
        $newStaff->password = bcrypt($request->matkhau);
        $newStaff->phone_number = $request->dienthoai;
        $listRole = "demo";
        // foreach ($request->roles as $val) {
        //     $listRole .= $val . ',';
        // }
        $listPage = "demo";
        // foreach ($request->choosepage as $val) {
        //     $listPage .= $val . ',';
        // }
        $newStaff->roles_id = $listRole ;
        $newStaff->page_access = $listPage;
        $newStaff->type_account = $request->typeaccount;
        if ($this->checkMailExs($request->email)) {
            session()->put('add_staff_fail', "that bai! email nay da ton tai");
            return view('admin_pages.managerpermission.add', compact('type_accounts'));
        } else {
            $newStaff->save();
            session()->put('add_staff_success', "them thanh cong!");
        }

        $getStaff = User::all();
        return view('admin_pages.managerpermission.index', compact('getStaff'));
    }
    public function checkMailExs($mail)
    {
        # code...
        $getmail = User::where('email', $mail)->get();
        if ($getmail->count() == 0) {
            return false;
        }
        return true;
    }

    public function delstaff($id)
    {
        $getdel = User::where('id', $id)->first();
        $getdel->delete();
        $checkdel = User::where('id', $id)->first();
        if($checkdel==null){
            session()->put('status_delstaff', true);
        }
        return redirect('admin/phan-quyen');
    }
    public function edit($id)
    {
        $staff = User::where('id', $id)->first();
        $typeAcc = type_account::all();
        return view('admin_pages.managerpermission.edit', compact('staff', 'typeAcc'));
    }
    public function update($id, Request $req)
    {
        $req->validate([
            'email_nv' => 'required|email|max:255',
            'ten_nv' => 'required|max:255',
            'sdt_nv' => 'required|max:10',
            'matkhau' => 'required|min:6|max:15'
        ]);
        $data = User::find($req->id);
        if ($data && $req->matkhau !== '') {
            $data['name_staff'] = $req->ten_nv;
            $data['email'] = $req->email_nv;
            $data['phone_number'] = $req->sdt_nv;
            $data['type_account'] = $req->typeaccount;
            $data['password'] = Hash::make($req->matkhau);
            $data->save();
        }
        // $getStaff = User::find($id);
        // $getStaff->name_staff = $req->ten_nv;
        // $getStaff->email = $req->email_nv;
        // $getStaff->phone_number = $req->sdt_nv;
        // $getStaff->type_account = $req->typeaccount;
        // $getStaff->save();
        session()->put('update_success', true);
        return redirect('admin/phan-quyen');
    }
    public function editinfo()
    {
        $id=Auth::user()->id;
        $staff = User::where('id', $id)->first();
        return view('admin_pages.infologin.edit1', compact('staff'));
    }
    public function updateinfo(Request $req)
    {
        $req->validate([
            'email' => 'required|email|max:255',
            'ten' => 'required|max:255',
            'dienthoai' => 'required|max:10',
        ]);

        $id = $req->id_nv;
        $getStaff = User::find($id);
        $getStaff->name_staff = $req->ten_nv;
        $getStaff->email = $req->email_nv;
        $getStaff->phone_number = $req->sdt_nv;
        $getStaff->save();
        session()->put('update_success', true);
        return redirect('admin/phan-quyen');
    }
}
