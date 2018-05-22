@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Quy trình</h3>
      </div>

    </div>
    <div class="clearfix"></div>
    <?php
    $id         = $arItems['id'];
    $name   = $arItems['name'];
    $content   = $arItems['content'];
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

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.process.edit',$id) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Lĩnh vực</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12"  name="name" placeholder="Vui lòng nhập thông tin" required="required" type="text" value="{{ $name }}" maxlength="255">
                        @if ($errors->Has ('name'))
                           <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('name') !!} </p>
                        @endif
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Detail</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea id="textarea" required="required" name="content" class="form-control col-md-7 col-xs-12">{!! $content !!}</textarea>
                        <script>
                         CKEDITOR.replace('content');
                       </script>
                       @if ($errors->Has ('content'))
                           <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('content') !!} </p>
                        @endif
                     </div>
                   </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="content-table">
                  <label class="control-label col-md-12 col-sm-12 col-xs-12" for="table">Thêm bảng và quy trình</label>
                  <div class="content-service col-md-12" style="padding: 0px; margin: 5px 0px;" >
                      <select id="heard" class="form-control filter_table" required name="linhvuc">
                            <option value="null">Chọn dịch vụ</option>
                            @foreach( $service as $key=>$item)
                              <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                  </div>
                  <div class="content-table col-md-12" style="border: 1px solid #ccc; padding: 10px; margin: 10px 0px; max-height: 400px; overflow-y: : autto">
                      @foreach($table as $item)
                        <div class="col-md-12 item_table show_{{$item['id_sevice']}}" style="border-bottom: 1px solid #ccc">
                          <input style="height: 18px; width: 18px; float: left" type="checkbox" value="{{$item['id']}}" data = "{{ $id }}" name="id_table[]" class="check_value_process" @if(array_search($item['id'],$table_check)!='') checked="true" @endif><label style="padding: 5px 5px">{{$item['name']}}</label> 
                        </div>
                      @endforeach
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