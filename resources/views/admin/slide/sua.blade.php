@extends('admin.layout.index');

@section('content');
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>{{$slide->Ten}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{$err}}<br/>
                        @endforeach
                    </div>
                @endif

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label>Tên</label>
                        <input value="{{$slide->Ten}}" class="form-control" name="Ten" placeholder="Nhập tên slide" />
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="3">{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input value="{{$slide->link}}" class="form-control" name="link" placeholder="Nhập tên slide" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p><img width="400px" src="upload/slide/{{$slide->Hinh}}"></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#TheLoai').change(function() {
                var idTheLoai = $(this).val();
                $.get('admin/ajax/loaitin/' + idTheLoai, function(data) {
                    $('#LoaiTin').html(data);
                });
            });
        });
    </script>
@endsection