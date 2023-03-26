@extends('templates.admins.layout')
@section('content')
<div class="show-message-page">
    @if (session('success_add_category'))
    <div class="show-alert-succes">
        <script type="text/javascript">
        $(document).ready(function() {
            Swal.fire({
                title: 'Thêm thành công!',
                icon: 'success',
                timer: 1000
            });
        });
        </script>
    </div>
    @endif
    @if (session('success_del_category'))
    <div class="show-alert-del-succes">
        <script type="text/javascript">
        $(document).ready(function() {
            Swal.fire({
                title: 'Xoá thành công!',
                icon: 'success',
                timer: 2000
            });
        });
        </script>
    </div>
    @endif
    @if (session('success_edit_category'))
    <div class="show-alert-del-succes">
        <script type="text/javascript">
        $(document).ready(function() {
            Swal.fire({
                title: 'Thay đổi thành công!',
                icon: 'success',
                timer: 2000
            });
        });
        </script>
    </div>
    <input id="result_edit" value="thanh cong" hidden>
    @endif
    @if (Session::has('success_edit_cat'))
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.success("Sửa thành công");
            });
        </script>
    @endif
    {{ Session::forget('success_edit_cat') }}


</div>
   
    <div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Danh mục món ăn</h3>
        <a href="{{ route('categories.addview') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Tạo mới
        </a>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th style="width: 10%;">Tên</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
                @foreach ($getCat as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $m->tenloai }}
                        </td>
                        <td>{{ $m->mota }}</td>
                        <td> <img style="widtd:80px;height:120px"
                                src="{{ asset('uploads/categories/' . $m->hinhanh) }}"></td>
                                <td>{{$m->trangthai==1?"Hoạt động":"Không hoạt động"}}</td>
                                <td>
                        
                        <a href="{{ route('categories.editview', $m->slug) }}" class="btn btn-info mgr-5" id="edit">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>

                        <a href="{{ route('categories.del', $m->id) }}" class="btn btn-danger mgr-5" id="delete">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- 
    <div class="content-show">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Loại</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="show-manager-material-use "style="font-size:16px;font-weight:bold">
                <?php $i = 1; ?>
                @foreach ($getCat as $m)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $m->tenloai }}
                        </td>
                        <td>{{ $m->mota }}</td>
                        <td> <img style="widtd:80px;height:120px"
                                src="{{ asset('uploads/categories/' . $m->hinhanh) }}"></td>
                                <td>{{$m->trangthai==1?"Hoạt động":"Không hoạt động"}}</td>
                        
                        <td>
                        
                        <a href="{{ route('categories.editview', $m->slug) }}" class="btn btn-info mgr-5" id="edit">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>

                        <a href="{{ route('categories.del', $m->id) }}" class="btn btn-danger mgr-5" id="delete">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> -->
{{ Session::forget('success_add_category') }}
{{ Session::forget('success_edit_category') }}
{{ Session::forget('success_del_category') }}
@endsection
