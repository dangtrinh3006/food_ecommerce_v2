@extends('templates.admins.layout')
@section('content')



@if (session('add_staff_fail'))
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.error("Email đã tồn tại!");
        });
    </script>
@endif
{{Session::forget('add_staff_fail')}}

<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Thêm nhân viên</h3>
        <div class="action">
            <a href="{{ route('roles.show')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('roles.addstaff') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form_group">
                            <label>Họ tên</label>
                            <input name="ten" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('ten'))
                        <span class="error text-danger">{{ $errors->first('ten') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Email</label>
                            <input name="email" type="email" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('email'))
                        <span class="error text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Số điện thoại</label>
                            <input type="number" name="dienthoai" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('dienthoai'))
                        <span class="error text-danger">{{ $errors->first('dienthoai') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Mật khẩu</label>
                            <input type="password" name="matkhau" id="matkhau" minlength="6" maxlength="15" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('matkhau'))
                        <span class="error text-danger">{{ $errors->first('matkhau') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Quyền hạn</label>
                            <select name="typeaccount" class="form_control">
                                @foreach ($type_accounts as $ac)
                                <option value="{{ $ac->id }}">
                                {{ $ac->type_account }}</option>
                                @endforeach
                               
                            </select>
                        </div>
                        @if($errors->first('size'))
                        <span class="error text-danger">{{ $errors->first('size') }}</span>
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

    
@endsection
