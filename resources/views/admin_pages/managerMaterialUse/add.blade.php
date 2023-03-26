@extends('templates.admins.layout')
@section('content')
    
    

@if(session()->has('failStatus'))
<script>
window.addEventListener('load', (e) => {
    toastr.error("{{session()->get('failStatus')}}");
})
</script>
@endif

<?php  //dd(session()->all());?>
   
    {{ Session::forget('failStatus') }}

    <div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Thêm nguyên liệu sử dụng</h3>
            <a href="{{ route('roles.show')}}" class="btn btn-primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        <div class="form-submit">
            <form action="{{ route('mmu.addhandle') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12 col-mb-12">
                        <div class="form_group">
                            <label>Nguyên liệu sử dụng</label>
                            <select name="materials" class="form_control">
                            @foreach ($materials as $m)
                            <option value="{{ $m->id }}">
                            {{ $m->ten_nglieu }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form_group">
                            <label>Số lượng sử dụng</label>
                            <input type="soluong" name="soluong" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('soluong'))
                        <span class="error text-danger">{{ $errors->first('soluong') }}</span>
                        @endif
                    </div>
                    <div class="col-12 action aciton_bottom">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu lại
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



    <!-- <div class="content-add">
        <form action="{{ route('mmu.addhandle') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-add-material-l">
                <div class="form_group">
                    <label>Chọn nguyên liệu sử dụng</label>
                    <select name="materials" class="form_control">
                        @foreach ($materials as $m)
                        <option value="{{ $m->id }}">
                        {{ $m->ten_nglieu }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input type="number" name="quantymmu" value="{{ old('quantymmu') }}">
                    <br>
                    <br><br>
                    @if ($errors->first('quantymmu'))
                        <div class="btn-danger">
                            {{ $errors->first('quantymmu') }}
                        </div>
                    @endif
                </div>

            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div> -->

    
@endsection
