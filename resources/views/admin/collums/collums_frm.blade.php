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

                            <form class="form-horizontal form-label-left" novalidate
                                  action="{{ route($action,$table[0]['id']) }}" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <div class="content-add-collums">
                                                @if(count($value_frm['name'])>0 && $value_frm['name']!='')
                                                    @for($i=0;$i<count($value_frm['name']);$i++)
                                                        <div class="item-cot"
                                                             style="border: 1px solid #ccc; padding: 10px 0px; margin-bottom:20px">
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên
                                                                    cột thứ <span
                                                                            class="content-stt">{{$i+1}}</span></label>
                                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                                    <input id="name"
                                                                           class="form-control col-md-7 col-xs-12"
                                                                           data-validate-length-range="6" name="name[]"
                                                                           placeholder="Vui lòng nhập tên cột"
                                                                           required="required" type="text"
                                                                           maxlength="255"
                                                                           value="{{$value_frm['name'][$i]}}">
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Export QrCode</label>
                                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                                    <input id="ex_qrcode"
                                                                           class=""
                                                                           data-validate-length-range="6" name="ex_qrcode[]"
                                                                           type="checkbox"
                                                                           value="{{$value_frm['ex_qrcode'][$i]}}">
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Type</label>
                                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                                    <select id="heard" class="form-control" required
                                                                            name="type[]">
                                                                        @foreach( $type as $key=>$item)
                                                                            <option @if($key == $value_frm['type'][$i])  selected="true"
                                                                                    @endif value="{{$key}}">{{$item}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <a class="add-collum btn btn-dark">Thêm cột</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <button type="reset" class="btn btn-dark">Reset</button>
                                            <button id="send" type="submit" class="btn btn-dark">Thêm</button>
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

    <div style="display: none;" class="content-frm-collum">
        <div class="item-cot" style="border: 1px solid #ccc; padding: 10px 0px; margin-bottom:20px">
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên cột thứ <span class="content-stt">1</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                           name="name[]" placeholder="Vui lòng nhập tên cột" required="required" type="text"
                           maxlength="255" value="">
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Export QrCode</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <select name="ex_qrcode[]" class="form-control">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Type</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <select id="heard" class="form-control" required name="type[]">
                        @foreach( $type as $key=>$item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

        </div>
    </div>
@endsection
