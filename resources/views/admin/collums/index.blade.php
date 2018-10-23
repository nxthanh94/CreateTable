@extends('templates.admin.template')
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn_show').click(function () {
                var type = $(this).attr('data-action');
                var col = $(this).attr('data-col');
                var val = $(this).attr('data-val');
                var id = $(this).attr('data-id');
                var token = '{{ csrf_token() }}';
                var url = '{{ route('admin.collums.ajaxchangeview')}}';
                ajax_change_view(col, val, id, token, url, type);
                //console.log(response);
            });
        });
        function ajax_change_view(col, val, id, token, url, type) {
            jQuery.ajax({
                type: 'POST',
                url: url,
                dataType:'json',
                data: {col:col,val:val,id:id,_token:token},
                success: function(data) {
                    if (type == 'show') {
                        $('#show_'+col+'_'+id).css({display:'none'});
                        $('#hide_'+col+'_'+id).css({display:'block'});
                    }
                    if (type == 'hide') {
                        $('#hide_'+col+'_'+id).css({display:'none'});
                        $('#show_'+col+'_'+id).css({display:'block'});
                    }
                }
            });
        }
    </script>
@endsection
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
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
                            <a href="{{ route('admin.collums.addcollums',$id_table) }}" class="btn btn-primary">Thêm
                                cột</a>
                            <a href="{{ route('admin.groupcollums.index',$id_table) }}" class="btn btn-primary">Quản lý
                                Group</a>
                            <a href="{{ route('admin.groupcollums.add',$id_table) }}" class="btn btn-primary">Tạo
                                Group</a>
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
                                    <th width="40px">STT</th>
                                    <th width="30px">ID</th>
                                    <th>Name</th>
                                    <th width="70px">Show PDF</th>
                                    <th width="100px">Show QRCODE</th>
                                    <th width="100px">Thao tác</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($arItems as $key => $arItem)
                                    <?php
                                    $urlEdit = route('admin.collums.edit', $arItem['id']);
                                    $urlDel = route('admin.collums.del', $arItem['id']);
                                    $label = "'stt'";
                                    ?>
                                    <tr>
                                        <td align="center"><input
                                                    onblur="change_value('collums',{{$arItem['id']}},{{$label}},this.value)"
                                                    style="width: 30px; padding: 2px 5px" type="text" name="stt"
                                                    data="{{$arItem['id']}}" value="{{$arItem['stt']}}"></td>
                                        <td>{{ $arItem['id'] }}</td>
                                        <td>{{ $arItem['name'] }}</td>
                                        <td width="70px">
                                            <button type="button"
                                                    style="display: {{ $arItem['showview'] == 1 ? 'none' : 'block' }}"
                                                    class="btn btn-primary btn-sm btn_show" data-action="show"
                                                    id="show_showview_{{ $arItem['id'] }}"
                                                    data-col="showview" data-val="1" data-id="{{ $arItem['id'] }}"><i
                                                        class="fa fa-eye"
                                                        aria-hidden="true"></i></button>
                                            <button type="button"
                                                    style="display: {{ $arItem['showview'] == 1 ? 'block' : 'none' }}"
                                                    class="btn btn-warning btn-sm btn_show" data-action="hide"
                                                    id="hide_showview_{{ $arItem['id'] }}" data-id="{{ $arItem['id'] }}"
                                                    data-col="showview" data-val="0"><i
                                                        class="fa fa-eye-slash"
                                                        aria-hidden="true"></i></button>
                                        </td>
                                        <td width="100px">
                                            <button type="button"
                                                    style="display: {{ $arItem['showqrcode'] == 1 ? 'none' : 'block' }}"
                                                    class="btn btn-primary btn-sm btn_show" data-action="show"
                                                    id="show_showqrcode_{{ $arItem['id'] }}"
                                                    data-col="showqrcode" data-val="1" data-id="{{ $arItem['id'] }}"><i class="fa fa-eye"
                                                                                      aria-hidden="true"></i></button>
                                            <button type="button"
                                                    style="display: {{ $arItem['showqrcode'] == 1 ? 'block' : 'none' }}"
                                                    class="btn btn-warning btn-sm btn_show" data-action="hide"
                                                    id="hide_showqrcode_{{ $arItem['id'] }}"
                                                    data-col="showqrcode" data-val="0" data-id="{{ $arItem['id'] }}"><i class="fa fa-eye-slash"
                                                                                      aria-hidden="true"></i></button>
                                        </td>
                                        <td>

                                            <a class="btn btn-success btn-xs" href="{{ $urlEdit }}">
                                                <i class="fa fa-pencil"></i> Sửa
                                            </a>
                                            <a href="{{ $urlDel }}" class="btn btn-primary btn-xs"
                                               onclick="return confirm('Bạn chắc muốn xóa không ?');">
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