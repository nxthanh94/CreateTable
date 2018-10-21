@extends('templates.admin.template')

@section('main')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách Thông báo</h2><br/>
                            <div class="clearfix"></div>
                            @if( Session::get('msg') != '')
                                <p style="color: red">{{ Session::get('msg') }}</p>
                            @endif
                        </div>
                        <div class="x_content">
                            <p class="text-muted font-13 m-b-30">
                                <a href="{{ route('admin.notification.create') }}" class="btn btn-success btn-md"></i>
                                    Thêm mới </a>
                            </p>
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th style="text-align: center;">Trạng thái</th>
                                    <th style="text-align: center;">Thao tác</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($arItems as $key => $arItem)
                                    <?php
                                    $id = $arItem['id'];
                                    $name = $arItem['name'];
                                    $status = $arItem['status'];
                                    $urlDel = route('admin.notification.del', $id);
                                    $urlEdit = route('admin.notification.edit', $id);
                                    ?>
                                    <tr>
                                        <td>{{ $name }}</td>
                                        @if($status == 0)
                                            <td>
                                                {{ $arItem->general == 1 ? 'Hệ thống' : 'Cá nhân' }}
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.newscate.status', ['id' => $id, 'status' => $status])}}">
                                                    <center><img src="{{ $url_admin }}/images/publish_x.png"></center>
                                                </a>
                                            </td>
                                        @endif
                                        <td style="text-align: center;">
                                            <a href="{{ $urlEdit }}" class="btn btn-info btn-xs"><i
                                                        class="fa fa-pencil"></i> Edit </a>
                                            <a href="{{ $urlDel }}" class="btn btn-danger btn-xs"
                                               onclick="return confirm('Bạn chắc muốn xóa không ?');"><i
                                                        class="fa fa-trash-o"></i> Delete </a>
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