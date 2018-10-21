@extends('templates.admin.template')

@section('main')
    <!-- page content -->
    <div class="right_col" role="main">
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

                            <form class="form-horizontal form-label-left" novalidate action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên</label>
                                                <div class="col-md-12 col-sm-10 col-xs-12">
                                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Vui lòng nhập thông tin" required="required" type="text" maxlength="255" value="{{ $notification['name'] }}">
                                                    @if ($errors->Has ('name'))
                                                        <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('name') !!} </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Mô tả</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <textarea id="textarea" required="required" rows="5" name="description" class="form-control col-md-7 col-xs-12">{{ $notification['description'] }}</textarea>
                                                    @if ($errors->Has ('description'))
                                                        <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('description') !!} </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="textarea">Nội dung</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <textarea id="textarea" required="required" name="content" class="form-control col-md-7 col-xs-12">{{ $notification['content'] }}</textarea>
                                                    <script>
                                                        CKEDITOR.replace('content');
                                                    </script>
                                                    @if ($errors->Has ('content'))
                                                        <p style="color:red;margin-bottom: 0px;display: inline-block;margin-top: 5px;"> {!!  $errors->First ('content') !!} </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="item form-group" style="padding: 20px;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{ $notification['highlight'] == 1 ? 'checked' : '' }} name="highlight" type="checkbox" id="inlineCheckbox1" value="1">
                                                    <label class="form-check-label" for="inlineCheckbox1">Highlight</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" {{ $notification['general'] == 1 ? 'checked' : '' }} name="general" type="checkbox" id="inlineCheckbox2" value="1">
                                                    <label class="form-check-label" for="inlineCheckbox2">Tin hệ thống</label>
                                                </div>
                                            </div>
                                            <div class="form-group item select2">
                                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="tags">Thông báo riêng</label>
                                                <select id="tags" name="to[]" class="form-control col-md-12" multiple="multiple">
                                                    @if($notification['users'] !== null)
                                                        @foreach($notification['users'] as $user)
                                                            <option selected="selected">{{ $user->username }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel" style="padding: 5px 5px 0px 5px;background: #E6E9ED;">
                                        <div class="x_content" style="text-align: center">
                                            <button type="reset" class="btn btn-dark">Làm lại</button>
                                            <button id="send" type="submit" class="btn btn-dark">Lưu</button>
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