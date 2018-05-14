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
    @if( Session::get('msg') != '')
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          {{ Session::get('msg') }}
        </div>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <a href="{{ route('admin.user.add') }}" class="btn btn-primary">Thêm</a>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
              </div>

              <div class="clearfix"></div>
              @foreach($arItems as $key => $arItem)
              <?php
              $id = $arItem['id'];
              $diachi = $arItem['diachi'];
              $id_cbcc = $arItem['id_cbcc'];
              $mota = $arItem['mota'];
              $username = $arItem['username'];
              $picture = $arItem['picture'];
              $id_phanquyen = $arItem['id_phanquyen'];
              $phone = $arItem['phone'];
              $hinhanh     = $arItem['picture'];
              $picUrl         = asset("storage/app/files/avata/{$hinhanh}");
              $urlEdit = route('admin.user.edit', $id);
              $urlDel  = route('admin.user.del', $id);
              ?>
              <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                <div class="well profile_view">
                  <div class="col-sm-12">
                    <?php
                    $arUser = DB::table('phanquyen')->where('id','=',$id_phanquyen)->first(); 
                    ?>
                    <h4 class="brief" @if($arUser['id'] == 1) style="color: red;font-weight: bold;" @endif><i>{{ $arUser['name'] }}</i></h4>
                    <div class="left col-xs-7">
                      <?php
                      $arName = DB::table('id',$id_cbcc)->first(); 
                      ?>
                      <h2 style="font-size: 16px;">Demo</h2>
                      <p><strong>About: </strong> {!! $mota !!} </p>
                      <ul class="list-unstyled">
                        <li><i class="fa fa-building"></i> Address: {{ $diachi }}</li>
                        <li><i class="fa fa-phone"></i> Phone : {{ $phone }}</li>
                      </ul>
                    </div>
                    <div class="right col-xs-5 text-center">
                      <img src="{{ $picUrl }}" alt="" class="img-circle img-responsive">
                    </div>
                  </div>
                  <div class="col-xs-12 bottom text-center">
                    <div class="col-xs-12 col-sm-6 emphasis">

                    </div>
                    <div class="col-xs-12 col-sm-6 emphasis">
                      <a class="btn btn-success btn-xs" href="{{ $urlEdit }}">
                        <i class="fa fa-pencil"></i> Xem
                      </a>
                      <a  href="{{ $urlDel }}" class="btn btn-primary btn-xs" onclick="return confirm('Bạn chắc muốn xóa không ?');">
                        <i class="fa fa-trash-o"> Xóa</i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection