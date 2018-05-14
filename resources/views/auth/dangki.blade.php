@extends('templates.public.template')

@section('main')

<!-- Page Content -->
<div class="prdt"> 
	<div class="container">
		<div class="prdt-top">
			<div class="col-md-9 prdt-left">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Đăng kí
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ route('auth.dangki') }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Vui lòng nhập Username" required />
                        @if ($errors->Has ('username'))
                           <p style="color:red"> {!!  $errors->First ('username') !!} </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="Vui lòng nhập mật khẩu" required />
                        @if ($errors->Has ('password'))
                           <p style="color:red"> {!!  $errors->First ('password') !!} </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập họ tên" required />
                        @if ($errors->Has ('name'))
                           <p style="color:red"> {!!  $errors->First ('name') !!} </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Vui lòng nhập Email" required />
                        @if ($errors->Has ('email'))
                           <p style="color:red"> {!!  $errors->First ('email') !!} </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" name="diachi" placeholder="Vui lòng nhập địa chỉ" required />
                        @if ($errors->Has ('diachi'))
                           <p style="color:red"> {!!  $errors->First ('diachi') !!} </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="sdt" placeholder="Vui lòng nhập số điện thoại" required />
                        @if ($errors->Has ('sdt'))
                           <p style="color:red"> {!!  $errors->First ('sdt') !!} </p>
                        @endif
                    </div>
                    <div class="form-group" >
                        <label>Cấp</label>
                        <label class="radio-inline">
                            <input name="phanquyen" value="3" type="radio" checked="" />Member
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->

</div>	
			
			@include('sanpham.right_bar')	
			
			
			<div class="clearfix"></div>
		</div>
	</div>
</div>
@endsection
@section('title')
Đăng kí
@endsection