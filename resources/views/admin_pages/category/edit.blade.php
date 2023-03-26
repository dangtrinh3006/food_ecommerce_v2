@extends('templates.admins.layout')
@section('content')
    
    {{-- @if (Session::has('errors_add'))
        <div class="alert alert-danger" style="font-size:24px"> {{ Session::get('errors_add') }}</div>
    @endif --}}
    @if (Session::has('error_nameexists'))
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.error("Tên đã tồn tại");
            });
        </script>
    @endif
    
    {{ Session::forget('error_nameexists') }}



    <div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sửa nguyên liệu</h3>
        <div class="action">
            <a href="{{ route('category.show')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('categories.edithandle',$editCat->id) }}" method="post"enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                            <div class="form_group">
                                <label>Tên danh mục</label>
                                <input name="categoryname_edit" id="ten_nglieu" value="{{ $editCat->tenloai }}" class="form_control" />
                                @if($errors->first('categoryname_edit'))
                            <span class="error text-danger">{{ $errors->first('categoryname_edit') }}</span>
                            @endif
                            </div>
                            
                            <div class="form_group">
                                <label>Mô tả</label>
                                <input name="des_edit" id="des_edit" value="{{ $editCat->mota }}" class="form_control" />
                                @if($errors->first('des_edit'))
                            <span class="error text-danger">{{ $errors->first('des_edit') }}</span>
                            @endif
                            </div>
                            
                
                    </div>
                    <div class="col-md-6 col-12">
                        
                        <div class="form_group">
                            <div class=" img-preview">
                                <label for="categoryImage" class="preview">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                    <span>Chọn ảnh cần thêm</soan>
                                        <img src="{{asset('uploads/categories/' . $editCat->hinhanh)}}"
                                            alt="{{$editCat->tenloai ?? ' Hình ảnh lỗi.'}}">
                                </label>
                                <input id="categoryImage" type="file" name="categoryImage" hidden class="form_control" />
                            </div>
                        </div>
                    </div>
                    
                    

                </div>

                        

                    </div>
                    
                    
                    <div class="col-12 action aciton_bottom">
                        <button type="submit" class="btn_add secondary" onclick="checkInputMaterial()"> 
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
window.onload = () => {
    const img = document.querySelector('#categoryImage');
    const preview = document.querySelector('.preview');

    img.addEventListener('change', (e) => {
        let file = e.target.files[0];
        if (!file) {
            return;
        }
        let img = document.createElement('img');
        let fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        // img.src = URL.createObjectURL(file);
        fileReader.onloadend = (e) => {
            img.src = e.target.result;
        }
        preview.appendChild(img);
    });




}
</script>

    <!-- <div class="content-add">
        <form action="{{route('categories.edithandle',$editCat->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id_cat" value="{{$editCat->id}}" hidden>
            <div class="form-add-material-l">
                <div class="form-group">
                    <label for="">Tên loại</label>
                    <input type="text" name="categoryname_edit" value="{{$editCat->tenloai}}">
                </div>
            </div>
            <div class="form-add-material-l">
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <input type="text" name="des_edit" value="{{$editCat->mota}}">
                </div>
            </div>
            <input type="text" name="oldename" id="" hidden value="{{$editCat->hinhanh}}">
            <div class="show-img-mal">
                <img src="{{ asset('uploads/categories/' . $editCat->hinhanh) }}" alt="{{ $editCat->tenloai }}"
                    id="preview_images" name="preview_images" style="width: 600px;height:300px">
            </div>
            <div class="form-group">
                <input type="file" name="categoryImage" id="categoryImage" onchange="preview_image(this)" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Luu</button>
        </form>
    </div> -->
@endsection
