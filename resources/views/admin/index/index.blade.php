@extends('templates.admin.template')

@section('main')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i>Users</span>
                <div class="count">{{ count($users) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Quy Trình</span>
                <div class="count">{{ count($process) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Dịch vụ</span>
                <div class="count green">{{ count($service) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Thông báo</span>
                <div class="count">{{ count($notification) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Bảng</span>
                <div class="count">{{ count($table) }}</div>
            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-12">
                            <h3>HỆ THỐNG CHẤT LƯỢNG VIỆT
                                <small>Thông báo</small>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="chart_plot_01" class="demo-placeholder">
                            @if (count($notification) > 0)
                                    @foreach($notification as $item)
                                        <div class="notification-item {{ $item->highlight == 1 ? 'highlight' : '' }}">
                                            <h3 class="title-notification"><a href="{{ route('admin.notification.show', $item->id) }}">{{ $item->name }}</a></h3>
                                            <p class="content-notification">{{ $item->description }}</p>
                                        </div>
                                    @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
    <!-- /page content -->
@endsection