<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;



class CategoriesController extends Controller
{
     //APIs for categories
     function getCategories()
     {
        $data = Categories::all();
        $payload = Crypt::encrypt($data);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $payload
        ],Response::HTTP_OK);
     }

     function getCategoryByID($id)
    {
        $data = Categories::find($id);
        $payload = Crypt::encrypt($data);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $payload
        ],Response::HTTP_OK);    
    }


    function addCategory(Request $req)
    {
        $category = new Categories;
        
        $category->tenloai=$req->tenloai;
        $category->slug=$req->slug;
        $category->mota=$req->mota;
        $category->hinhanh=$req->hinhanh;
        $category->trangthai=$req->trangthai;
        
        $result=$category->save();
        if($result){
            return ["Result"=>"Data has been saved"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    function updateCategoryAPI(Request $req){
        $category = Categories::find($req->id);

        $category->tenloai=$req->tenloai;
        $category->slug=$req->slug;
        $category->mota=$req->mota;
        $category->hinhanh=$req->hinhanh;
        $category->trangthai=$req->trangthai; 
        
        $result=$category->save();


        if($result){
            return ["Result"=>"Data has been updated"];
        }else{
            return ["Result"=>"Operation failed"];
        }    
    }

    function deleteCategoryAPI($id){
        $category = Categories::find($id);
        $result = $category->delete();

        if($result){
            return ["Result"=>"Data has been deleted"];
        }else{
            return ["Result"=>"Operation failed"];
        }    
    }


    public function index()
    {
        $getCat = Categories::all();
        return view('admin_pages.category.index', compact('getCat'));
    }

    public function add()
    {
        return view('admin_pages.category.add');
    }
    public function create(Request $request)
    {
        $request->validate([
            'namecategory' => 'required|max:255',
            'categoriesIMG' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100000',
            'descriptioncategory' => 'required'
        ]);

        $nameImage = $this->uploadImage($request);
        $newCategory = new Categories();
        $newCategory->tenloai = $request->namecategory;
        $newCategory->mota = $request->descriptioncategory;
        $newCategory->hinhanh = $nameImage;
        $newCategory->slug = Str::slug($request->namecategory);

        if ($this->checkName(Str::slug($request->namecategory))) {
            return redirect('admin/category-add');
        }
        $newCategory->save();
        $getCat = Categories::all();
        session()->put('success_add_category', 'them thanh cong');
        return redirect('admin/category');
    }


    public function checkName($slug)
    {
        $mal = Categories::where('slug', $slug)->get('slug');
        $checkName = "";
        foreach ($mal as $m) {
            $checkName = $m->slug;
        }
        if ($slug == $checkName) {
            return true;
        }
        return false;
    }
    public function edit($slug)
    {
        $editCat = Categories::where('slug', $slug)->first();
        return view('admin_pages.category.edit', compact('editCat'));
    }
    public function checkNames($name)
    {
        $mal = Categories::where('tenloai', $name)->get('tenloai');
        $checkName = "";
        foreach ($mal as $m) {
            $checkName = $m->tenloai;
        }
        if ($name == $checkName) {
            return true;
        }
        return false;
    }
    function update($id, Request $req)
    {
        $updateCat = Categories::where('id', $id)->first();

        $name = "";
        $oldName = $updateCat->tenloai;
        $newName = $req->categoryname_edit;
        if ($newName == $oldName) {
            $name = $oldName;
        } else {
            $name = $newName;
            if ($this->checkNames($name)) {
                session()->put('error_nameexists', true);
                return redirect()->back();
            }
        }
        $updateCat->tenloai = $name;
        $updateCat->mota = $req->des_edit;
        $slug = Str::slug($req->categoryname_edit);
        $updateCat->slug = $slug;
        
        $img = $req->file('categoryImage');
        if ($img) {
            $newImage = rand(1, 9999999) . '.' . $img->getClientOriginalExtension();
            $img->move('uploads/categories', $newImage);
            $updateCat->hinhanh = $newImage;
        }


        $updateCat->save();
        $getCat = Categories::all();
        session()->put('success_edit_cat', 'sua thanh cong');
        return view('admin_pages.category.index', compact('getCat'));
    }
    function deletecat($id)
    {
        $delCat = Categories::find($id);
        $delCat->delete();
        session()->put('success_del_category', 'xoa thanh cong');
        return redirect('admin/category');
    }
    public function uploadImage($req)
    {
        $imageName = "";
        $images = $req->file('categoriesIMG');
        if ($req->hasFile('categoriesIMG')) {
            $images = $req->file('categoriesIMG');
            $imageName = time() . '.' . $images->extension();
            $images->move(public_path('uploads/categories/'), $imageName);
        }
        return $imageName;
    }
}

