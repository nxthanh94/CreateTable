<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$title}}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="content_frm_login">
        	<p>Vui lòng nhập thông tin đăng nhập!</p>
        	<form name="frm_login" method="post" class="form-horizontal form-label-left" action="{{route($action)}}">
        		{{ csrf_field() }}
        		<div class="item form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="user" class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Nhập user" required="required" type="text">
                      </div>
                </div>
                <div class="item form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="user" class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password"  required="required" type="password">
                      </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                    <button id="send" type="submit" class="btn btn-success">Đăng nhập</button>
                    <button type="reset" class="btn btn-primary">Huỷ bỏ</button>
                    <a href="{{route('login.forgot')}}" class="btn btn-warning">Quên mật khẩu</a>
                  </div>
                </div>
                @if(Session::get('msg') != "")
                    <p style="color: red">{{ Session::get('msg') }}</p>
                @endif
        	</form>	
        </section>
    </div> 
</div>