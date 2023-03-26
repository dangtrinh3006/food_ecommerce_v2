@extends('templates.admins.layout')
@section('content')


<div class="show-message-page">
    @if (session('success_add_pro'))
    <div class="show-alert-succes">
        <script type="text/javascript">
        $(document).ready(function() {
            Swal.fire({
                title: 'Thêm thành công!',
                icon: 'success',
                timer: 2000
            });
        });
        </script>
    </div>
    @endif
    @if (session('success_edit_pro'))
    <div class="show-alert-succes">
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
    @endif

    @if (session('success_del_pro'))
    <div class="show-alert-succes">
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

    {{-- delete session --}}
    {{ Session::forget('success_add_pro') }}
    {{ Session::forget('success_edit_pro') }}
    {{ Session::forget('success_del_pro') }}



</div>



<div class="container-fluid coupon form_ql">
    <div class="card_1">
        <h3 class="card-title">Sản phẩm</h3>
        <a href="{{ route('products.addview') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            Tạo mới
        </a>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th style="width: 10%;">Tên</th>
                    <th>Giá bán</th>
                    <th>Hình ảnh</th>
                    <th>Kích cỡ</th>
                    <th>Trạng thái</th>
                    <th>Mô tả sản phẩm</th>
                    <th>Nội dung</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach ($spham as $sp)
            <tr>
                <td>{{ $sp->id }}</td>
                <td>{{ $sp->tensp }}</td>
                <td>{{ currency_format($sp->giaban) }}</td>
                <td><img style="widtd:100px;height:150px" src="{{ asset('uploads/product/' . $sp->hinhanh) }}">
                </td>
                <td>
                    @foreach ($sp->size as $value)
                    {{ $value->size_name }}
                    @endforeach
                </td>
                <td>
                    <?php if ($sp->trangthai == 1) {
                        echo "<button class='btnstatus btn btn-primary ' value='$sp->id'>Hiển thị</button>";
                    } else {
                        echo "<button class='btnstatus btn btn-secondary ' value='$sp->id'>Ẩn</button>";
                    } ?>
                </td>
                
                <td ><span class="line-5">{{ $sp->mota }}</span></td>
                <td id="contenpro"><span class="line-5">{{ $sp->noidung }}</span></td>
                
                <td>
                        
                        <a href="{{ route('products.editview', $sp->slug) }}" class="btn btn-info mgr-5" id="edit">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>

                        <a href="{{ route('products.del', $sp->id) }}" class="btn btn-danger mgr-5" id="edit">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>

            </tr>
            @endforeach
            </tbody>
        </table>
        <span>{{ $spham->links() }}</span>

    </div>
    
</div>


@endsection