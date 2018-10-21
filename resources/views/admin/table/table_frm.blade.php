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

                            <form class="form-horizontal form-label-left" novalidate action="{{ route($action,$id) }}"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên
                                                    bảng</label>
                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <input id="name" class="form-control col-md-7 col-xs-12"
                                                           data-validate-length-range="6" name="name"
                                                           placeholder="Vui lòng nhập thông tin" required="required"
                                                           type="text" maxlength="255" value="{{$value_frm['name']}}">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Qrcode</label>
                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <input id="name" class="checkbox"
                                                           data-validate-length-range="6" name="qrcode"
                                                           placeholder="Vui lòng nhập thông tin"
                                                           type="checkbox" value="{{$value_frm['qrcode']}}">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Header</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <textarea id="textarea" required="required" name="header"
                                                              class="form-control col-md-7 col-xs-12">{{$value_frm['header']}}</textarea>
                                                    <script>
                                                        CKEDITOR.replace('header');
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Footer</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <textarea id="textarea" required="required" name="footer"
                                                              class="form-control col-md-7 col-xs-12">{{$value_frm['footer']}}</textarea>
                                                    <script>
                                                        CKEDITOR.replace('footer');
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
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
@endsection