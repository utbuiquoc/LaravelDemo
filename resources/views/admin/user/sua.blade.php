@extends('admin.layout.index');

@section('content');
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>{{$user->name}}</small>
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
                <form action="admin/user/sua/{{$user->id}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input value="{{$user->name}}" class="form-control" name="name" placeholder="Nhập tên người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{$user->email}}" type="email" class="form-control" name="email" readonly="" placeholder="Nhập địa chỉ email" />
                    </div>
                    <div class="form-group">
                        <input id="changePassword" type="checkbox" value="Đổi mật khẩu" name="changePassword">
                        <label>Password</label>
                        <input id="password1" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" disabled=""/>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại password</label>
                        <input id="password2" type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu" disabled=""/>
                    </div>
                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" 
                            @if ($user->quyen == 0)
                                {{"checked"}}
                            @endif
                             type="radio">Thường
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" 
                            @if ($user->quyen == 0)
                                {{"checked"}}
                            @endif
                             value="1" type="radio">Admin
                        </label>
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
        checkBtn = document.querySelector('#changePassword');
        passwordInput1 = document.querySelector('#password1');
        passwordInput2 = document.querySelector('#password2');
        checkBtn.onclick = function() {
            if (checkBtn.checked == true) {
                passwordInput1.removeAttribute('disabled');
                passwordInput2.removeAttribute('disabled');
            } else {
                passwordInput1.setAttribute('disabled', "");
                passwordInput2.setAttribute('disabled', "");
            }
        }
    </script>
@endsection