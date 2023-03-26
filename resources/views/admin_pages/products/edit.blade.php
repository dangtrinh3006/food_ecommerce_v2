@extends('templates.admins.layout')
@section('content')
    

    {{ Breadcrumbs::render('Sửa sản phẩm', $spham->slug) }}
    <div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sửa món ăn</h3>
        <div class="action">
            <a href="{{ route('get.post')}}" class="btn_add primary">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Quay lại
            </a>    
        </div>
        <div class="form-submit">
            <form action="{{ route('products.edithandle', $spham->id)  }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="form_group">
                            <label>Tên món ăn</label>
                            <input value="{{ $spham->tensp }}" name="ten_spham" id="ten_spham" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('ten_spham'))
                        <span class="error text-danger">{{ $errors->first('ten_spham') }}</span>
                        @endif

                        <div class="form_group">
                            <label>Giá bán</label>
                            <input value="{{ $spham->giaban }}" name="giaban" id="giaban" autocomplete='off' class="form_control" />
                        </div>
                        @if($errors->first('giaban'))
                        <span class="error text-danger">{{ $errors->first('giaban') }}</span>
                        @endif

                        
                        
                        <div class="form_group">
                            <label>Danh mục</label>
                            <select name="select_cat" class="form_control">
                            @foreach ($catetype as $dvnl)
                                @if ($dvnl->id == $spham->id_loaisanpham)
                                    <option name="" id="" selected="selected" value="{{ $dvnl->id }}">
                                        {{ $dvnl->tenloai }}</option>

                                @else{
                                    <option name="" id="" value="{{ $dvnl->id }}">
                                        {{ $dvnl->tenloai }}</option>
                                    }
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="form_group">
                            <label>Trạng thái</label>
                            <select name="status_product" class="form_control">
                                @if ($spham->trangthai == 1)
                                    <option name="" id="" selected="selected" value="1">
                                        Hiện</option>
                                    <option name="" id=""  value="0">
                                    Ẩn</option>
                                @else{
                                    <option name="" id=""  value="1">
                                        Hiện</option>
                                    <option name="" id="" selected="selected" value="0">
                                        Ẩn</option>
                                    }
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form_group">
                            <div class=" img-preview">
                                <label for="ProductImage" class="preview">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                    <span>Chọn ảnh cần thêm</soan>
                                        <img src="{{asset('uploads/product/' . $spham->hinhanh)}}"
                                            alt="{{$spham->tensp ?? ' Hình ảnh lỗi.'}}">
                                </label>
                                <input id="ProductImage" type="file" name="ProductImage" hidden class="form_control" />
                            </div>
                        </div>
                        @if($errors->first('ProductImage'))
                        <span class="error text-danger">{{ $errors->first('ProductImage') }}</span>
                        @endif

                    </div>
                    <div class="col-12">
                        <div class="form_group">
                            <label>Mô tả sản phẩm</label>
                            <textarea class="form_control" name="description_edit" id="description_edit">{{$spham->mota}}</textarea>
                        </div>
                        @if($errors->first('description_edit'))
                        <span class="error text-danger">{{ $errors->first('description_edit') }}</span>
                        @endif
                        <div class="form_group">
                            <label>Nội dung</label>
                            <textarea class="form_control" name="conten_edit" id="conten_edit">{{$spham->noidung}}</textarea>
                        </div>
                        @if($errors->first('conten_edit'))
                        <span class="error text-danger">{{ $errors->first('conten_edit') }}</span>
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

    <!-- <div class="content-edit-show">
        <form action="{{ route('products.edithandle', $spham->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-edit-mal editind">
                <div class="form-edit-left">
                    <input type="text" name="id_spham" id="id_spham" value="{{ $spham->id }}" hidden>
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="ten_spham" id="ten_spham" value="{{ $spham->tensp }}" class="form-control">
                        @if ($errors->first('ten_spham'))
                        <div class="btn-danger">
                            {{ $errors->first('ten_spham') }}
                        </div>
                    @endif
                    </div>
                    <div class="form-group">
                        <label for="">Giá bán</label>
                        <input type="text" name="giaban" id="giaban" value="{{ $spham->giaban }}" class="form-control">
                        @if ($errors->first('giaban'))
                        <div class="btn-danger">
                            {{ $errors->first('giaban') }}
                        </div>
                    @endif
                    </div>
                    <div class="form-group">
                        <label for="">Loại sản phẩm</label>
                        <select name="select_cat">
                            @foreach ($catetype as $dvnl)
                                @if ($dvnl->id == $spham->id_loaisanpham)
                                    <option name="" id="" selected="selected" value="{{ $dvnl->id }}">
                                        {{ $dvnl->tenloai }}</option>

                                @else{
                                    <option name="" id="" value="{{ $dvnl->id }}">
                                        {{ $dvnl->tenloai }}</option>
                                    }
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-edit-right">
                        <div class="form-group">
                            <input type="text" hidden value="{{ $spham->hinhanh }}" name="imageOld">
                        </div>
                        <div class="show-img-mal">
                            <img src="{{ asset('uploads/product/' . $spham->hinhanh) }}" alt="{{ $spham->ten_spham }}"
                                id="preview_images" name="preview_images" style="width: 600px;height:300px">
                        </div>
                        <div class="form-group">
                            <input type="file" name="ProductImage" id="ProductImage" onchange="preview_image(this)"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung</label><br>
                            <textarea name="conten_edit" id="conten_edit" cols="100" rows="20" >{{$spham->noidung}}</textarea>
                            @if ($errors->first('conten_edit'))
                            <div class="btn-danger">
                                {{ $errors->first('conten_edit') }}
                            </div>
                        @endif
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label><br>
                            <textarea name="description_edit" id="" cols="100" rows="20" >{{$spham->mota}}</textarea>
                            @if ($errors->first('description_edit'))
                            <div class="btn-danger">
                                {{ $errors->first('description_edit') }}
                            </div>
                        @endif
                        </div>
                        <p>Trạng thái</p>
                        @if ($spham->trangthai == 1)
                            <input type="radio" id="showstatus" name="status_product" value="1" checked>
                            <label for="css">Hiện</label><br>
                            <input type="radio" id="hidestatus" name="status_product" value="0">
                            <label for="html">Ẩn</label><br>
                        @else
                            <input type="radio" id="showstatus" name="status_product" value="1">
                            <label for="html">Hiện</label><br>
                            <input type="radio" id="hidestatus" name="status_product" value="0" checked>
                            <label for="html">Ẩn</label><br>
                        @endif
                        <br>



                    </div>
                    <button type="submit" class="btn btn-success" style="margin-left: 200px">Lưu thay đổi</button>
                </div>

        </form>

    </div> -->
@endsection
