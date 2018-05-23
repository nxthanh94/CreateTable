 <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <h3 class="title_sidebar"><a href="#">CHỌN DỊCH VỤ ĐANG ÁP DỤNG</a></h3>
                        </li>
                        @foreach($service as $item)
                        <li>
                            <a href="#">{{$item['service_cat']['name']}}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($item['newsservice'] as $value)
                                <li>
                                    <?php
                                        $slug = str_slug($value['name']);
                                    ?>
                                    <a href="{{route('service.getid',['slug'=>$slug,'id'=>$value['id']])}}">{{$value['name']}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>