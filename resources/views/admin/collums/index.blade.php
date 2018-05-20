@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>{{ $title}}</h3>
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
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <a href="{{ route('admin.collums.addcollums',$id_table) }}" class="btn btn-primary">Thêm cột</a>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
				  <th  width="40px">STT</th>
                  <th width="30px">ID</th>
                  <th >Name</th>
                  <th width="100px">Thao tác</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $urlEdit = route('admin.collums.edit', $arItem['id']);
                $urlDel  = route('admin.collums.del', $arItem['id']);
               	$label = "'stt'";
                ?>
                <tr>
                  <td align="center"><input onblur="change_value('collums',{{$arItem['id']}},{{$label}},this.value)" style="width: 30px; padding: 2px 5px" type="text" name="stt" data="{{$arItem['id']}}" value="{{$arItem['stt']}}"></td>
                  <td>{{ $arItem['id'] }}</td>
                  <td>{{ $arItem['name'] }}</td>
                  <td>
                  	
                    <a class="btn btn-success btn-xs" href="{{ $urlEdit }}">
                      <i class="fa fa-pencil"></i> Sửa
                    </a>
                    <a  href="{{ $urlDel }}" class="btn btn-primary btn-xs" onclick="return confirm('Bạn chắc muốn xóa không ?');">
                      <i class="fa fa-trash-o"> Xóa</i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /page content -->
@endsection