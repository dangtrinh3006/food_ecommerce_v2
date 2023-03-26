@extends('templates.admins.layout')
@section('content')

    <div class="message-show-edit-mal">
        @if (session('error_nameexists'))
            <div class="show-alert-error">
                <script type="text/javascript">
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Tên đã tồn tại',
                            icon: 'warning',
                            timer: 2000
                        });
                    });
                </script>
            </div>
        @endif
        @if (session('error_timeexp'))
            <div class="show-alert-succes">
                <script type="text/javascript">
                    $(document).ready(function() {
                        toastr.warning("Ngày hết hạn nhỏ hơn ngày nhập");
                    });
                </script>
            </div>
        @endif

        {{ Session::forget('error_nameexists') }}
        {{ Session::forget('error_timeexp') }}

    </div>

    
    <div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sửa nguyên liệu</h3>
        <div class="action">
            <a href="{{ route('showMaterial')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('material.edithandle', $nglieu->id)}}" method="post" id="form-add-material" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                            <div class="form_group">
                                <label>Tên nguyên liệu</label>
                                <input name="ten_nglieu" id="ten_nglieu" value="{{ $nglieu->ten_nglieu }}" class="form_control" />
                                @if($errors->first('ten_nglieu'))
                            <span class="error text-danger">{{ $errors->first('ten_nglieu') }}</span>
                            @endif
                            </div>
                            
                            
                            <div class="form_group">
                                <label>Đơn vị nguyên liệu</label>
                                {{-- <input type="text" name="MaterialUnit" id="MaterialUnit" class="form-control"> --}}
                                <select name="select_unit" class="form_control">
                                @foreach ($dv_nglieu as $dvnl)
                                @if ($dvnl->ten_don_vi == $nglieu->don_vi_nglieu)
                                    <option name="" id="" selected="selected"
                                        value="{{ $dvnl->ten_don_vi }}">
                                        {{ $dvnl->ten_don_vi }}</option>

                                @else{
                                    <option name="" id="" value="{{ $dvnl->ten_don_vi }}">
                                        {{ $dvnl->ten_don_vi }}</option>
                                    }
                                @endif
                                @endforeach
                                </select>
                            </div>
                            
                            <div class="form_group">
                                <label>Giá nhập</label>
                                <input value="{{ $nglieu->gia_nhap }}" type="number" autocomplete='off' name="gia_nhap" id="gia_nhap" class="form_control" />
                                @if($errors->first('gia_nhap'))
                            <span class="error text-danger">{{ $errors->first('gia_nhap') }}</span>
                            @endif
                            </div>
                            <div class="form_group">
                                <label>Số lượng</label>
                                <input value="{{ $nglieu->so_luong }}" name="so_luong" id="so_luong" type="number" autocomplete='off' name="giamgia" class="form_control" />
                                @if($errors->first('so_luong'))
                            <span class="error text-danger">{{ $errors->first('so_luong') }}</span>
                            @endif
                            </div>
                           
                            <div class="form_group">
                                <label>Hạn sử dụng</label>
                                <input value="{{ $fm_date_expi }}" name="dateEXP" id="dateEXP" type="date" class="form_control" min="<?= date('Y-m-d'); ?>" />
                                @if($errors->first('dateEXP'))
                                <span class="error text-danger">{{ $errors->first('dateEXP')}}</span>
                                @endif
                            </div>
                             
                            <div class="form_group">
                                <label>Ngày nhập</label>
                                <input value="{{ $fm_date_in }}" name="dateIn" id="dateIn" type="date" class="form_control" min="<?= date('Y-m-d'); ?>" />
                                @if($errors->first('dateIn'))
                                <span class="error text-danger">{{ $errors->first('dateIn')}}</span>
                                @endif
                            </div>
                           
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
                        

                        <div class="form_group">
                            <div class=" img-preview">
                                <label for="MaterialImage" class="preview">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                    <span>Chọn ảnh cần thêm</soan>
                                        <img src="{{asset('uploads/materials/' . $nglieu->hinh_anh)}}"
                                            alt="{{$nglieu->ten_nglieu ?? ' Hình ảnh lỗi.'}}">
                                </label>
                                <input id="MaterialImage" type="file" name="MaterialImage" hidden class="form_control" />
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
    const img = document.querySelector('#MaterialImage');
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

<!-- 
    <div class="content-edit-show">
        <form action="{{ route('material.edithandle', $nglieu->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-edit-mal">
                <div class="form-edit-left showind">
                    <input type="text" name="id_nglieu" id="id_nglieu" value="{{ $nglieu->id }}" hidden>
                    <div class="form-group">
                        <label for="">Tên nguyên liệu</label>
                        <input type="text" name="ten_nglieu" id="ten_nglieu" value="{{ $nglieu->ten_nglieu }}">
                        @if ($errors->first('ten_nglieu'))
                            <div class="btn-danger">
                                {{ $errors->first('ten_nglieu') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Giá nhập</label>
                        <input type="text" name="gia_nhap" id="gia_nhap" value="{{ $nglieu->gia_nhap }}">
                        @if ($errors->first('gia_nhap'))
                            <div class="btn-danger">
                                {{ $errors->first('gia_nhap') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="text" name="so_luong" id="so_luong" value="{{ $nglieu->so_luong }}">
                        @if ($errors->first('so_luong'))
                            <div class="btn-danger">
                                {{ $errors->first('so_luong') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Đơn vị</label>
                        <select name="select_unit">
                            @foreach ($dv_nglieu as $dvnl)
                                @if ($dvnl->ten_don_vi == $nglieu->don_vi_nglieu)
                                    <option name="" id="" selected="selected"
                                        value="{{ $dvnl->ten_don_vi }}">
                                        {{ $dvnl->ten_don_vi }}</option>

                                @else{
                                    <option name="" id="" value="{{ $dvnl->ten_don_vi }}">
                                        {{ $dvnl->ten_don_vi }}</option>
                                    }
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->first('select_unit'))
                            <div class="btn-danger">
                                {{ $errors->first('select_unit') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Ngày hết hạn</label>
                        <input type="date" name="dateEXP" id="dateEXP" value="{{ $fm_date_expi }}"
                            class="form-control">
                        @if ($errors->first('dateEXP'))
                            <div class="btn-danger">
                                {{ $errors->first('dateEXP') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Ngày nhập</label>
                        <input type="date" name="dateIn" id="dateIn" value="{{ $fm_date_in }}"
                            class="form-control">
                    </div>
                </div>
                <div class="form-edit-right">
                    <div class="form-group">
                        <input type="text" hidden value="{{ $nglieu->hinh_anh }}" name="imageOld" id="imageOld">
                    </div>
                    <div class="show-img-mal">
                        <img src="{{ asset('uploads/materials/' . $nglieu->hinh_anh) }}"
                            alt="{{ $nglieu->ten_nglieu }}" id="preview_images" name="preview_images"
                            style="width: 600px;height:300px">
                    </div>
                    <div class="form-group">
                        <input type="file" name="MaterialImage" id="MaterialImage" onchange="preview_image(this)"
                            class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" style="margin-left: 200px">Lưu thay đổi</button>
        </form>

    </div> -->
@endsection
