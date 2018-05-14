@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Câu hỏi</h3>
      </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Cập nhật</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.cauhoi.edit',$arCauhoi['id']) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên câu hỏi</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="name" placeholder="Vui lòng nhập thông tin" required="required" type="text" value="{{ $arCauhoi['name'] }}" maxlength="255">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã câu hỏi</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" name="id_cauhoi" placeholder="Vui lòng nhập thông tin" required="required" type="text" maxlength="255" value="{{ $arCauhoi['id_cauhoi'] }}">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Lĩnh vực</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <select id="heard" class="form-control" required name="linhvuc">
                          @foreach($arItems as $key => $arItem)
                          @if($arItem['id'] == $arCauhoi['id_linhvuc'])
                          <option selected="selected" value="{{ $arItem['id'] }}">{{ $arItem['name'] }}</option>
                          @else
                          <option value="{{ $arItem['id'] }}">{{ $arItem['name'] }}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Đáp án A</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea id="textarea" required="required" name="a" class="form-control col-md-7 col-xs-12">{!! $arCauhoi['a'] !!}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Đáp án B</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea id="textarea" required="required" name="b" class="form-control col-md-7 col-xs-12">{!! $arCauhoi['b'] !!}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Đáp án C</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea id="textarea" required="required" name="c" class="form-control col-md-7 col-xs-12">{!! $arCauhoi['c'] !!}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Đáp án D</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea id="textarea" required="required" name="d" class="form-control col-md-7 col-xs-12">{!! $arCauhoi['d'] !!}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Đáp án đúng</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <div class="row">
                          <div class="col-md-2 col-sm-2 col-xs-3" style="padding-top: 8px;">
                            <input type="radio" class="flat" @if($arCauhoi['dapan'] == 'a') checked @endif name="dapan" value="a"> &nbsp;A
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-3" style="padding-top: 8px;">
                            <input type="radio" class="flat" name="dapan" value="b" @if($arCauhoi['dapan'] == 'b') checked @endif> &nbsp;B
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-3" style="padding-top: 8px;">
                            <input type="radio" class="flat" name="dapan" value="c" @if($arCauhoi['dapan'] == 'c') checked @endif> &nbsp;C
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-3" style="padding-top: 8px;">
                            <input type="radio" class="flat" @if($arCauhoi['dapan'] == 'd') checked @endif name="dapan" value="d"> &nbsp;D
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel" style="padding: 5px 5px 0px 5px;background: #E6E9ED;">
                  <div class="x_content">
                    <button type="reset" class="btn btn-dark" style="float: left;">Reset</button>
                    <button id="send" type="submit" class="btn btn-dark" style="float: right;">Sửa</button>
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