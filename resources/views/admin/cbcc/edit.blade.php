@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Cán bộ công chức</h3>
      </div>

    </div>
    <div class="clearfix"></div>
    <?php
    $id         = $arItems['id'];
    $donvi         = $arItems['donvi'];
    $madonvi         = $arItems['madonvi'];
    $name   = $arItems['name'];
    $picture = $arItems['picture'];
    $picUrl     = asset("storage/app/files/avata/{$picture}");
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sửa</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.cbcc.edit',$id) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Họ và tên</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Vui lòng nhập thông tin" required="required" type="text" value="{{ $name }}" maxlength="255">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã đơn vị</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12"  name="madonvi" placeholder="Vui lòng nhập thông tin" required="required" type="text" value="{{ $madonvi }}" maxlength="255">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên đơn vị</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12"  name="donvi" placeholder="Vui lòng nhập thông tin" required="required" type="text" value="{{ $donvi }}" maxlength="255">
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Ảnh cũ</label>
                          <img src="{{ $picUrl }}" width="99px" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="x_panel" style="padding: 5px 5px 0px 5px;background: #E6E9ED;">
                  <div class="x_content">
                    <button type="reset" class="btn btn-dark" style="float: left;">Reset</button>
                    <button id="send" type="submit" class="btn btn-dark" style="float: right;">Cập nhật</button>
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