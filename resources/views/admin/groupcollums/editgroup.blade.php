@extends('templates.admin.template')
@section('main')
  <div class="content-main right_col" role="main">
    <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>{{$title}}</h3>
      </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sửa group</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route($action,$value_frm['id']) }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên group</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="name" placeholder="Vui lòng nhập tên group" required="required" type="text" maxlength="255" value="{{$value_frm['name']}}">
                      </div>
                    </div>
                  </div>
                  <!--Collums-->
                  <div class="content-collums form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Danh sách cột</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      @foreach($collums as $Item)
                        <div class="item-collums col-md-12 col-sm-12">
                          <input style="width:25px;height: 17px;" class="check_value" data="{{$value_frm['id']}}" type="checkbox" name="id_collums[]" @if(array_search($Item['id'],$collums_group)!='') checked="true" @endif value="{{$Item['id']}}"><label >{{$Item['name']}}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  <!--End Collums-->
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <button type="reset" class="btn btn-dark" >Reset</button>
                    <button id="send" type="submit" class="btn btn-dark" >Submit</button>
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
@endsection
