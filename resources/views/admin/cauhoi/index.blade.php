@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Câu hỏi</h3>
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
    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="import_file" />
      <button class="btn btn-primary">Import File</button>
    </form>
    <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <a href="{{ route('admin.cauhoi.add') }}" class="btn btn-primary">Thêm</a>
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
                  <th>ID</th>
                  <th>Câu hỏi</th>
                  <th>Mã câu hỏi</th>
                  <th>Lĩnh vực</th>
                  <th>Đáp án</th>
                  <th width="100px">Thao tác</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $urlEdit = route('admin.cauhoi.edit', $arItem['id']);
                $urlDel  = route('admin.cauhoi.del', $arItem['id']); 
                ?>
                <tr>
                  <td>{{ $arItem['id'] }}</td>
                  <td>{{ $arItem['name'] }}</td>
                  <td>{{ $arItem['id_cauhoi'] }}</td>
                  <?php
                  $arLinhvuc = DB::table('linhvuc')->where('id','=',$arItem['id_linhvuc'])->first(); 
                  ?>
                  <td>{{ $arLinhvuc['name'] }}</td>
                  <td>{{ $arItem['dapan'] }}</td>
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