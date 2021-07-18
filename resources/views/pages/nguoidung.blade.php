@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
			  	<div class="panel-heading">Thông tin tài khoản</div>
			  	<div class="panel-body">
			    	<form action="nguoidung" method="POST">
			    		{{csrf_field()}}
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
			    		<div>
			    			<label>Họ tên</label>
						  	<input value="{{$nguoidung->name}}" type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
						</div>
						<br>
						<div>
			    			<label>Email</label>
						  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
						  	readonly value="{{$nguoidung->email}}" 
						  	>
						</div>
						<br>	
						<div>
							<input id="changePassword" type="checkbox" class="" name="changePassword">
			    			<label>Đổi mật khẩu</label>
						  	<input type="password" class="form-control" id="password1" name="password" aria-describedby="basic-addon1" disabled>
						</div>
						<br>
						<div>
			    			<label>Nhập lại mật khẩu</label>
						  	<input type="password" class="form-control" id="password2" name="passwordAgain" aria-describedby="basic-addon1" disabled>
						</div>
						<br>
						<button type="submit" class="btn btn-default">Sửa
						</button>

			    	</form>
			  	</div>
			</div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->
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