@extends('templates.admin.template')
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
           $('.get_col').change(function () {
               var tableId = $(this).val();
               var token = '{{ csrf_token() }}';
               var url = '{{ route('admin.relationship.ajax_get_collums')}}';
               var idOuput = $(this).attr('data-id');
               ajax_change_view(tableId, token, url, idOuput);
           });
        });
        function ajax_change_view(tableId, token, url, idOuput) {
            jQuery.ajax({
                type: 'POST',
                url: url,
                dataType:'json',
                data: {table_id:tableId,_token:token},
                success: function(data) {
                    $(idOuput).html(data);
                }
            });
        }
    </script>
@endsection
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

                            <form class="form-horizontal form-label-left" novalidate action="{{ $action }}"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Bảng
                                                    liên kết</label>
                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <select id="id_table_pri" class="form-control col-md-7 col-xs-12 get_col"
                                                            data-validate-length-range="6" name="id_table_pri" data-id ="#col_pri"
                                                            placeholder="Vui lòng chọn bảng" required="required">
                                                        <option value="">--</option>
                                                        @foreach ($tableList as $table)
                                                            <option {{ $table['id'] ==  $value_frm['id_table_pri'] ? 'selected' : '' }}  value="{{ $table['id'] }}">{{ $table['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Cột liên kết</label>
                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <select id="col_pri" class="form-control col-md-7 col-xs-12"
                                                            data-validate-length-range="6" name="col_pri"
                                                            placeholder="Vui lòng chọn cột" required="required">
                                                        <option value="">--</option>
                                                        @if (!empty($colPri))
                                                            @foreach ($colPri as $col)
                                                                <option {{ $col['id'] ==  $value_frm['col_pri'] ? 'selected' : '' }} value="{{ $col['id'] }}">{{ $col['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Bảng
                                                    tham chiếu</label>
                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <select id="id_table_for" class="form-control col-md-7 col-xs-12 get_col"
                                                            data-validate-length-range="6" name="id_table_for" data-id ="#col_for"
                                                            placeholder="Vui lòng chọn bảng" required="required">
                                                        <option value="">--</option>
                                                        @foreach ($tableList as $table)
                                                            <option {{ $table['id'] ==  $value_frm['id_table_for'] ? 'selected' : '' }} value="{{ $table['id'] }}">{{ $table['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Cột tham chiếu</label>
                                                <div class="col-md-10 col-sm-10 col-xs-12">
                                                    <select id="col_for" class="form-control col-md-7 col-xs-12"
                                                            data-validate-length-range="6" name="col_for"
                                                            placeholder="Vui lòng chọn cột" required="required">
                                                        <option value="">--</option>
                                                        @if (!empty($colFor))
                                                            @foreach ($colFor as $col)
                                                                <option {{ $col['id'] ==  $value_frm['col_for'] ? 'selected' : '' }} value="{{ $col['id'] }}">{{ $col['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
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