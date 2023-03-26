@extends('templates.admins.layout')
@section('content')
{{ Breadcrumbs::render('Thêm sản phẩm') }}

<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Thêm món ăn</h3>
        <div class="action">
            <a href="{{ route('get.post')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>    
        </div>
        <div class="form-submit">
            <form action="{{ route('products.addhandle') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="form_group">
                            <label>Tên món ăn</label>
                            <input name="ProductName" id="ProductName" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('ProductName'))
                        <span class="error text-danger">{{ $errors->first('ProductName') }}</span>
                        @endif

                        <div class="form_group">
                            <label>Giá bán</label>
                            <input name="SellPrice" id="SellPrice" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('SellPrice'))
                        <span class="error text-danger">{{ $errors->first('SellPrice') }}</span>
                        @endif

                        <div class="form_group">
                            <label>Size</label>
                            <select name="size" class="form_control">
                                @foreach ($size as $s)
                                <option value="{{ $s->id }}">
                                {{ $s->size_name }}</option>
                                @endforeach
                                <option value="2">
                                Nhỏ - Lớn</option>
                            </select>
                        </div>
                        @if($errors->first('size'))
                        <span class="error text-danger">{{ $errors->first('size') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Danh mục</label>
                            <select name="select_cat" class="form_control">
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">
                                {{ $cat->tenloai }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="img-preview">
                            <label for="ProductImage" class="preview">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <span>Chọn ảnh cần thêm</soan>
                            </label>
                            @if($errors->first('ProductImage'))
                            <span class="error text-danger">{{ $errors->first('ProductImage') }}</span>
                            @endif
                            <input id="ProductImage" type="file" name="ProductImage" hidden class="form_control" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form_group">
                            <label>Mô tả sản phẩm</label>
                            <textarea class="form_control" name="Description" id="Description"></textarea>
                        </div>
                        @if($errors->first('Description'))
                        <span class="error text-danger">{{ $errors->first('Description') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Nội dung</label>
                            <textarea class="form_control" name="contenproduct" id="contenproduct"></textarea>
                        </div>
                        @if($errors->first('contenproduct'))
                        <span class="error text-danger">{{ $errors->first('contenproduct') }}</span>
                        @endif
                    </div>
                    <div class="col-12 action aciton_bottom">
                        <button type="submit" class="btn_add secondary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu lại
                        </button>
                    </div>
                    @if ($errors->any())
                    <script type="text/javascript">
                        $(document).ready(function() {
                            toastr.error("Kiểm tra lại giá trị nhập vào");
                        });
                    </script>
                @endif
                @if (session('error_nameexists'))
                    <div class="show-alert-error">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'Tên sản phẩm đã tồn tại',
                                    icon: 'warning',
                                    timer: 2000
                                });
                            });
                        </script>
                    </div>
                @endif
                </div>
                {{ Session::forget('error_nameexists') }}
            </form>
        </div>
    </div>
</div>
<script>
window.onload = () => {
    const img = document.querySelector('#ProductImage');
    const preview = document.querySelector('.preview');
    CKEDITOR.config.height = 600;

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


@endsection
