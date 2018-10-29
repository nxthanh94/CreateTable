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
                            <a href="{{ route('admin.relationship.create',$id_process) }}" class="btn btn-primary">Thêm</a>
                            <a href="{{ route('admin.process.index',$id_process) }}" class="btn btn-primary">Quy Trình</a>
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
                                    <th width="30px">ID</th>
                                    <th>Bảng liên kết</th>
                                    <th>Bảng tham chiếu</th>
                                    <th width="150px">Thao tác</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($arItems as $key => $arItem)
                                    <?php
                                    $urlEdit = route('admin.relationship.editpost', $arItem['id']);
                                    $urlDel = route('admin.relationship.del', $arItem['id']);
                                    $tableFor = DB::table('table')->where('id', $arItem['id_table_for'])->select('name')->get();
                                    if (!empty($tableFor)) {
                                        $nameTableFro = $tableFor[0]->name;
                                    }
                                    $tablePri = DB::table('table')->where('id', $arItem['id_table_pri'])->select('name')->get();
                                    if (!empty($tablePri)) {
                                        $nameTablePri = $tablePri[0]->name;
                                    }
                                    ?>
                                    <tr>
                                        <td>{{ $arItem['id'] }}</td>
                                        <td>{{ $nameTablePri }}</td>
                                        <td>{{ $nameTableFro }}</td>
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