<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12">
        <div class="">
          <div class="x_title">
            <h2>Thông tin cá nhân</h2>
    
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
           <?php
           $id         = $arUsers['id'];
           $username   = $arUsers['username'];
           $email   = $arUsers['email'];
           $diachi   = $arUsers['diachi'];
           $phone   = $arUsers['phone'];
           $name   = $arUsers['name'];
           $picture = $arUsers['picture'];
           $picUrl     = asset("storage/app/files/avata/{$picture}");
           ?>
           <form class="form-horizontal form-label-left" novalidate action="{{ route($action,$id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-9 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Họ và tên</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="name" placeholder="Vui lòng nhập thông tin" required="required" type="text" maxlength="255" value="{!! $name !!}">
                      @if ($errors->Has ('name'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('name') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Username</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input class="form-control col-md-7 col-xs-12" name="username" placeholder="Vui lòng nhập thông tin" required="required" type="text" maxlength="255" value="{!! $username !!}">
                      @if ($errors->Has ('username'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('username') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Mật khẩu</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="password" name="password" class="form-control col-md-7 col-xs-12" maxlength="100">
                      @if ($errors->Has ('password'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('password') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nhập lại MK</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="password" name="password2" class="form-control col-md-7 col-xs-12" maxlength="100">
                      @if ($errors->Has ('password2'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('password2') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input  class="form-control col-md-7 col-xs-12" name="email" placeholder="Vui lòng nhập thông tin" required="required" type="email" maxlength="255" value="{!! $email !!}">
                      @if ($errors->Has ('email'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('email') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" placeholder="Vui lòng nhập thông tin" maxlength="20" value="{!! $phone !!}">
                      @if ($errors->Has ('phone'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('phone') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input  class="form-control col-md-7 col-xs-12" name="diachi" placeholder="Vui lòng nhập thông tin" required="required" type="text" maxlength="255" value="{!! $diachi !!}">
                      @if ($errors->Has ('diachi'))
                      <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('diachi') !!} </p>
                      @endif
                    </div>
                  </div>
                  <div class="item form-group">
                      
                          <label class="control-label col-md-2 col-sm-12 col-xs-12">Avatar</label>
                        
                     
                      <div class="col-md-10 col-sm-12 col-xs-12">
                        <input type="file" name="picture">
                        @if ($errors->Has ('picture'))
                        <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('picture') !!} </p>
                        @endif
                        <img src="{{ $picUrl }}" width="99px" />
                      </div>
                      
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                        <div class="col-md-10 col-sm-12 col-xs-12">
                        <button type="reset" class="btn btn-dark">Nhập lại</button>
                        <button id="send" type="submit" class="btn btn-success" >Cập nhật</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->