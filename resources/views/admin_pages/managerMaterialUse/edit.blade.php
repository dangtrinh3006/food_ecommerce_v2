@extends('templates.admins.layout')
@section('content')
  
    {{-- @if (Session::has('errors_add'))
        <div class="alert alert-danger" style="font-size:24px"> {{ Session::get('errors_add') }}</div>
    @endif --}}
    @if(session()->has('failStatus'))
<script>
window.addEventListener('load', (e) => {
    toastr.error("{{session()->get('failStatus')}}");
})
</script>
@endif

    <div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sửa nguyên liệu sử dụng</h3>
        <div class="action">
            <a href="{{ route('showMaterial')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>
        </div>
        <div class="form-submit">
            <form action="{{ route('mmu.edithandle',$getmmu->id)}}" method="post" id="form-add-material" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                            <div class="form_group">
                                <label>Tên nguyên liệu</label>
                                <input name="namemmu" id="namemmu" value="{{$namemal}}" class="form_control" />
                                @if($errors->first('namemmu'))
                            <span class="error text-danger">{{ $errors->first('namemmu') }}</span>
                            @endif
                            </div>
                            
                            
                            <div class="form_group">
                                <label>Số lượng</label>
                                <input value="{{$getmmu->so_luong}}" name="quantymmu" id="quantymmu" type="number" autocomplete='off' name="giamgia" class="form_control" />
                                @if($errors->first('quantymmu'))
                            <span class="error text-danger">{{ $errors->first('quantymmu') }}</span>
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
                    
                    
                    

                </div>

                        

                    </div>
                    
                    
                    <div class="col-12 action aciton_bottom">
                        <button type="submit" class="btn_add secondary" > 
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 
    <div class="content-add form-update-mmu">
        <form action="{{route('mmu.edithandle',$getmmu->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" value="{{$getmmu->id}}" hidden>
            <div class="form-add-material-l">
                <div class="form-group">
                    <label for="">Tên nguyên liệu sử dụng</label>
                    <input type="text" name="namemmu" value="{{$namemal}}" readonly>
                </div>
            </div>
            <div class="form-add-material-l">
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input type="number" name="quantymmu" value="{{$getmmu->so_luong}}">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Lưu thông tin</button>
        </form>
    </div> -->


@endsection
