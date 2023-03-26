@extends('templates.admins.layout')
@section('content')

{{ Breadcrumbs::render('Thêm nguyên liệu') }}


    @if (Session::has('failadd'))
        <div class="alert alert-danger" style="font-size:24px"> {{ Session::get('failadd') }}</div>
    @endif
    @if (session('error_date'))
        <div class="show-alert-succes">
            <script type="text/javascript">
                $(document).ready(function() {
                    toastr.warning("Ngày hết hạn nhỏ hơn ngày hôm nay");
                });
            </script>
        </div>
    @endif
<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Tạo nguyên liệu</h3>
        <div class="action">
            <a href="{{ route('showMaterial')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('material.addhandle')}}" method="post" id="form-add-material" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                        

                            <div class="form_group">
                                <label>Tên nguyên liệu</label>
                                <input name="MaterialName" id="MaterialName" class="form_control" />
                                @if($errors->first('MaterialName'))
                            <span class="error text-danger">{{ $errors->first('MaterialName') }}</span>
                            @endif
                            </div>
                            
                            
                            <div class="form_group">
                                <label>Đơn vị nguyên liệu</label>
                                {{-- <input type="text" name="MaterialUnit" id="MaterialUnit" class="form-control"> --}}
                                <select name="select_unit" class="form_control">
                                @foreach ($dv_nglieu as $dvnl)
                                <option name="" id="" value="{{ $dvnl->ten_don_vi }}">
                                    {{ $dvnl->ten_don_vi }}</option>
                            @endforeach
                                </select>
                            </div>
                            
                            <div class="form_group">
                                <label>Giá nhập</label>
                                <input type="number" autocomplete='off' name="ImportPrice" id="ImportPrice" class="form_control" />
                                @if($errors->first('ImportPrice'))
                            <span class="error text-danger">{{ $errors->first('ImportPrice') }}</span>
                            @endif
                            </div>
                            <div class="form_group">
                                <label>Số lượng</label>
                                <input name="MaterialQuantily" id="MaterialQuantily" type="number" autocomplete='off' name="giamgia" class="form_control" />
                                @if($errors->first('MaterialQuantily'))
                            <span class="error text-danger">{{ $errors->first('MaterialQuantily') }}</span>
                            @endif
                            </div>
                           
                                
                            <div class="form_group">
                                <label>Hạn sử dụng</label>
                                <input name="ExpiredDate" id="ExpiredDate" type="date" class="form_control" min="<?= date('Y-m-d'); ?>" />
                                @if($errors->first('ExpiredDate'))
                                <span class="error text-danger">{{ $errors->first('ExpiredDate')}}</span>
                                @endif
                                </div>
                            

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
                                @if ($errors->any())
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            toastr.error("Kiểm tra lại giá trị nhập vào");
                                        });
                                    </script>
                                @endif
                                {{-- delete session --}}
                                {{ Session::forget('error_nameexists') }}
                                {{ Session::forget('error_date') }}


                    </div>
                    <div class="col-md-6 col-12">
                        <div class="img-preview">
                            <label for="MaterialImage" class="preview">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <span>Chọn ảnh cần thêm</soan>
                            </label>
                            @if($errors->first('MaterialImage'))
                            <span class="error text-danger">{{ $errors->first('MaterialImage') }}</span>
                            @endif
                            <input id="MaterialImage" type="file" name="MaterialImage" hidden class="form_control" />
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
    const img = document.querySelector('#MaterialImage');
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
   

    <!-- <div class="content-add input-group-css showind">
        <form action="{{ route('material.addhandle') }}" method="post" id="form-add-material" enctype="multipart/form-data">
            @csrf
            <div class="form-input" style="display: flex;justify-content: space-between">
                <div class="form-add-material-l" style="width: 100%">
                    <div class="form-group">
                        <label for="">Tên nguyên liệu</label>
                        <input type="text" name="MaterialName" id="MaterialName" class="form-control">
                        @if ($errors->first('MaterialName'))
                            <div class="btn-danger">
                                {{ $errors->first('MaterialName') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Giá Nhập</label>
                        <input type="number" name="ImportPrice" id="ImportPrice" class="form-control">

                        @if ($errors->first('ImportPrice'))
                            <div class="btn-danger">
                                {{ $errors->first('ImportPrice') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="text" name="MaterialQuantily" id="MaterialQuantily" class="form-control">
                        @if ($errors->first('MaterialQuantily'))
                            <div class="btn-danger">
                                {{ $errors->first('MaterialQuantily') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" name="MaterialImage" id="MaterialImage" class="form-control"
                            onchange="preview_image_add()">
                        @if ($errors->first('MaterialImage'))
                            <div class="btn-danger">
                                {{ $errors->first('MaterialImage') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Đơn vị nguyên liệu</label>
                        {{-- <input type="text" name="MaterialUnit" id="MaterialUnit" class="form-control"> --}}
                        <select name="select_unit">
                            @foreach ($dv_nglieu as $dvnl)
                                <option name="" id="" value="{{ $dvnl->ten_don_vi }}">
                                    {{ $dvnl->ten_don_vi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hạn sử dụng</label>
                        <input type="date" name="ExpiredDate" id="ExpiredDate" class="form-control">
                        @if ($errors->first('ExpiredDate'))
                            <div class="btn-danger">
                                {{ $errors->first('ExpiredDate') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="show-img-mal">
                    <img src="{{ asset('uploads/materials/noimage.jpg') }}" name="hinh_anh_add" id="hinh_anh_add"
                        style="width: 600px;height:300px">

                </div>
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
                @if ($errors->any())
                    <script type="text/javascript">
                        $(document).ready(function() {
                            toastr.error("Kiểm tra lại giá trị nhập vào");
                        });
                    </script>
                @endif
                {{-- delete session --}}
                {{ Session::forget('error_nameexists') }}
                {{ Session::forget('error_date') }}

            </div>
            <button type="submit" class="btn btn-success" onclick="checkInputMaterial()" id="btn-add-material">Lưu</button>
        </form>
    </div> -->
@endsection
