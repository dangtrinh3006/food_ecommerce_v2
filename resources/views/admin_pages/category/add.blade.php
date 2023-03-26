@extends('templates.admins.layout')
@section('content')

<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Tạo danh mục</h3>
        <div class="action">
            <a href="{{ route('category.show')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('categories.addhandle')}}" method="post" id="form-add-material" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                        

                            <div class="form_group">
                                <label>Tên danh mục</label>
                                <input name="namecategory" class="form_control" />
                                @if($errors->first('namecategory'))
                            <span class="error text-danger">{{ $errors->first('namecategory') }}</span>
                            @endif
                            </div>
                            <div class="form_group">
                                <label>Mô tả</label>
                                <input name="descriptioncategory" class="form_control" />
                                @if($errors->first('descriptioncategory'))
                            <span class="error text-danger">{{ $errors->first('descriptioncategory') }}</span>
                            @endif
                            </div>
                            
                        <label for="">Hình ảnh</label>
                        <input type="file" name="categoriesIMG" id="categoriesIMG" class="form-control"
                            onchange="preview_image_add()">
                            @if ($errors->first('categoriesIMG'))
                                <span class="error text-danger">{{ $errors->first('categoriesIMG') }}</span>                            @endif
                        
                    </div>
                            
                @if ($errors->any())
                    <script type="text/javascript">
                        $(document).ready(function() {
                            toastr.error("Kiểm tra lại giá trị nhập vào");
                        });
                    </script>
                @endif
                
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




@endsection
