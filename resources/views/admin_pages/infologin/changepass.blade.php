@extends('templates.admins.layout')
@section('content')

@if(session()->has('successStatus'))
<script>
window.addEventListener('load', (e) => {
    toastr.success("{{session()->get('successStatus')}}");
})
</script>
@endif
@if(session()->has('failStatus'))
<script>
window.addEventListener('load', (e) => {
    toastr.error("{{session()->get('failStatus')}}");
})
</script>
@endif
{{ Session::forget('successStatus') }}
{{ Session::forget('failStatus') }}

<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Đổi mật khẩu</h3>
            <a href="{{ route('infologin') }}" class="btn btn-primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        
        <div class="form-submit">
            <form action="{{ route('changepass') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-6 col-mb-12">
                        
                        <div class="form_group">
                            <label>Nhập mật khẩu cũ</label>
                            <input name="oldpass" id="oldpass" maxlength="15" minlength="6" required   type="password" autocomplete='off'
                                class="form_control" />
                        </div>
                        <div class="form_group">
                            <label>Nhập mật khẩu mới</label>
                            <input name="newpass" id="newpass" maxlength="15" minlength="6" required   type="password" autocomplete='off'
                                class="form_control" />
                        </div>
                        <div class="form_group">
                            <label>Xác nhận mật khẩu</label>
                            <input name="newpass2" id="newpass2" maxlength="15" minlength="6" required   type="password" autocomplete='off'
                                class="form_control" />
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

    <!-- <div class="infologin" style="font-weight: bold">

        <div class="title-show">
            <h3 style="font-size:18px">Đổi mật khẩu</h3>
        </div>
        <form action="{{ route('changepass') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nhập mật khẩu cũ </label>
                <input type="password" name="oldpass" id="oldpass" maxlength="15" minlength="10" required>
            </div>
            <div class="form-group">
                <label for="">Nhập mật khẩu mới </label>
                <input type="password" name="newpass" id="newpass" maxlength="15" minlength="10" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
        </form>

    </div> -->
@endsection
