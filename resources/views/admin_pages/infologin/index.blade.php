@extends('templates.admins.layout')
@section('content')

@if (session('change_pass'))
<div class="notify-del-mal" id="notify-del-mal">
    <h4 style="background: green;padding: 10px;text-align:center;width: 500px;color: white;">
        Thay đổi mật khẩu thành công</h4>

</div>
@endif
{{ Session::forget('change_pass') }}

<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Thông tin cá nhân</h3>
        
        <div class="form-submit">
            <form enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9 col-12 col-mb-12">
                        <div class="form_group">
                            <label>Họ tên</label>
                            <input disabled name="ten_nv" value="{{ $getLogin->name_staff }}" autocomplete='off' class="form_control" />
                        </div>
                        
                        <div class="form_group">
                            <label>Email</label>
                            <input disabled name="email_nv" value="{{$getLogin->email}}" readonly type="email" autocomplete='off'
                                class="form_control" />
                        </div>
                       
                        <div class="form_group">
                            <label>Số điện thoại</label>
                            <input disabled type="number" value="{{$getLogin->phone_number}}" name="sdt_nv"
                                 class="form_control" />
                        </div>
                        
                        <div class="form_group">
                            <label>Quyền hạn</label>
                            @if ($getLogin->type_account == 1)
                            <input disabled value="Admin" class="form_control" />
                            @endif
                            @if ($getLogin->type_account == 2)
                            <input disabled value="Nhân viên chăm sóc khách hàng" class="form_control" />
                            @endif
                            @if ($getLogin->type_account == 3)
                            <input disabled value="Nhân viên quản lý thông tin" class="form_control" />
                            @endif
                            @if ($getLogin->type_account == 4)
                            <input disabled value="Nhân viên quản lý kho" class="form_control" />
                            @endif
                            @if ($getLogin->type_account == 5)
                            <input disabled value="Nhân viên giao hàng" class="form_control" />
                            @endif
                        </div> 
                         
                        
                    </div>
                    <div class="col-12 action aciton_bottom">
                    <a href="{{route('updateinfo.view')}}" class="btn btn-primary">
                        
                        Sửa thông tin
                    </a>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>



<!-- <div class="infologin" style="font-weight: bold">
    <div class="infolog">
        Email: {{ $getLogin->email }}
    </div>
    <div class="infolog">
        Tên nhân viên: {{ $getLogin->name_staff }}
    </div>
    <div class="infolog">
        Số điện thoại: {{ $getLogin->phone_number }}
    </div>
    <div class="infolog">
        Loại tài khoản:
        @if ($getLogin->type_account == 1)
        admin
        @endif
        @if ($getLogin->type_account == 2)
        nhân viên pha chế
        @endif
        @if ($getLogin->type_account == 3)
        nhân viên bán hàng
        @endif
        @if ($getLogin->type_account == 4)
        nhân viên thu ngân
        @endif

    </div>
    <a href="{{route('updateinfo.view')}}">Sửa thông tin</a>
    <a href="{{ route('viewupdatepass') }}">Đổi mật khẩu</a>
    <a href="{{ route('showDashboard') }}">Quay lại</a>
</div> -->


@endsection