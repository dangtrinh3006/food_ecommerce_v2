@extends('templates.admins.layout')
@section('content')

<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sửa thông tin thành viên</h3>
        <div class="action">
            <a href="{{ route('roles.show')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('staff.edithandle', $staff->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form_group">
                            <label>Họ tên</label>
                            <input name="ten_nv" value="{{ $staff->name_staff }}" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('ten_nv'))
                        <span class="error text-danger">{{ $errors->first('ten_nv') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Email</label>
                            <input name="email_nv" value="{{$staff->email}}" readonly type="email" autocomplete='off'
                                class="form_control" />
                        </div>
                        @if($errors->first('email_nv'))
                        <span class="error text-danger">{{ $errors->first('email_nv') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Số điện thoại</label>
                            <input type="number" value="{{$staff->phone_number}}" name="sdt_nv"
                                autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('sdt_nv'))
                        <span class="error text-danger">{{ $errors->first('sdt_nv') }}</span>
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
                                @foreach ($typeAcc as $value)
                                    @if ($value->id == $staff->type_account)
                                        <option value="{{ $value->id }}"selected="selected">{{ $value->type_account }}
                                        </option>
                                    @else
                                        <option value="{{ $value->id }}"> {{ $value->type_account }}
                                        </option>
                                    @endif
                                @endforeach
                               
                            </select>
                        </div>
                        
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
        <form action="{{ route('staff.edithandle', $staff->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="form-edit-left">
                    <input type="text" name="id_nv" id="id_nv" value="{{ $staff->id }}" hidden>
                    <div class="form-group">
                        <label for="">Tên nhân viên</label>
                        <input type="text" name="ten_nv" id="ten_nv" value="{{ $staff->name_staff }}">
                        @if ($errors->first('ten_nv'))
                            <div class="btn-danger">
                                {{ $errors->first('ten_nv') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email_nv" id="email_nv" value="{{ $staff->email }}">
                        @if ($errors->first('email_nv'))
                            <div class="btn-danger">
                                {{ $errors->first('email_nv') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="sdt_nv" id="sdt_nv" value="{{ $staff->phone_number }}">
                        @if ($errors->first('sdt_nv'))
                            <div class="btn-danger">
                                {{ $errors->first('sdt_nv') }}
                            </div>
                        @endif
                    </div>
                    <div class="type-account">
                        <label for="">Chọn loại tài khoản</label>
                        <select name="typeaccount" id="">
                            @foreach ($typeAcc as $value)
                                @if ($value->id == $staff->type_account)
                                    <option value="{{ $value->id }}"selected="selected">{{ $value->type_account }}
                                    </option>
                                @else
                                    <option value="{{ $value->id }}"> {{ $value->type_account }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" style="margin-left: 200px">Lưu thay đổi</button>
        </form>

    </div> -->
@endsection
