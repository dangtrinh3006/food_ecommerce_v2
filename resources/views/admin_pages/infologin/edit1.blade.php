@extends('templates.admins.layout')
@section('content')
   
<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sửa thông tin cá nhân</h3>
            <a href="{{ route('infologin') }}" class="btn btn-primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        
        <div class="form-submit">
            <form action="{{ route('updateinfo.handle', $staff->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form_group">
                            <label>Họ tên</label>
                            <input name="name" value="{{ $staff->name_staff }}" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('name'))
                        <span class="error text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Email</label>
                            <input name="email" value="{{$staff->email}}" readonly type="email" autocomplete='off'
                                class="form_control" />
                        </div>
                        @if($errors->first('email'))
                        <span class="error text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Số điện thoại</label>
                            <input type="dienthoai" value="{{$staff->phone_number}}" name="sdt_nv"
                                autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('dienthoai'))
                        <span class="error text-danger">{{ $errors->first('dienthoai') }}</span>
                        @endif
                       
                        
                    </div>
                    <div class="col-12 action aciton_bottom">
                        <button type="submit" class="btn_add secondary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu lại
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- <div class="content-edit-show showind">
        <form action="{{ route('updateinfo.handle', $staff->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="form-edit-left">
                    <input type="text" name="id_nv" id="id_nv" value="{{ $staff->id }}" hidden>
                    <div class="form-group">
                        <label for="">Tên nhân viên</label>
                        <input type="text" name="ten" id="ten" value="{{ $staff->name_staff }}">
                        @if ($errors->first('ten'))
                            <div class="btn-danger">
                                {{ $errors->first('ten') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" value="{{ $staff->email }}">
                        @if ($errors->first('email'))
                            <div class="btn-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="dienthoai" id="dienthoai" value="{{ $staff->phone_number }}">
                        @if ($errors->first('dienthoai'))
                            <div class="btn-danger">
                                {{ $errors->first('dienthoai') }}
                            </div>
                        @endif
                    </div>
            
                    <button type="submit" class="btn btn-success" style="margin-left: 200px">Lưu thay đổi</button>
        </form>

    </div> -->
@endsection
