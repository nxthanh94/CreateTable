@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User</h3>
      </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Thêm</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.user.add') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Username</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="username" placeholder="Vui lòng nhập thông tin" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Cán bộ</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <select id="heard" class="form-control" required name="linhvuc">
                          <?php
                          $arCanbo = DB::table('cbcc')->whereNotIn('id',$arDanhmuc)->get();
                          ?>
                          @foreach($arCanbo as $key => $Canbo)
                          <option value="{{ $Canbo['id'] }}">{{ $Canbo['name'] }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Mật khẩu</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Nhập lại MK</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" placeholder="Vui lòng nhập thông tin">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="diachi" placeholder="Vui lòng nhập thông tin" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Giới thiệu</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea id="textarea" required="required" name="mota" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel" style="margin-bottom: 0px;">
                  <div class="row">
                    <div class="x_title">
                      <h2 style="font-size: 14px;font-weight: bold;">Hình ảnh</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li style="float: right;"><a class="collapse-link"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="item form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input type="file" name="picture">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="x_panel" style="padding: 5px 5px 0px 5px;background: #E6E9ED;">
                  <div class="x_content">
                    <button type="reset" class="btn btn-dark" style="float: left;">Reset</button>
                    <button id="send" type="submit" class="btn btn-dark" style="float: right;">Thêm</button>
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
@endsection