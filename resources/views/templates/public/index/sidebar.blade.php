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
                        <?php
                            $id_user =0;
                        ?>
                        @if(Auth::check())
                            <?php 
                                $id_phanquyen = Auth::user()->id_phanquyen;
                                $id_user = Auth::user()->id;
                                if($id_phanquyen == 1 || $id_phanquyen ==2)
                                {
                                    $table = DB::table('table')->get(); 
                                }
                                else
                                {
                                    $table = DB::table('table')
                                            ->join('tableasuser','table.id','=','tableasuser.id_table')
                                            ->where('tableasuser.id_user','=',$id_user)
                                            ->select('table.*')->get();
                                }
                                
                            ?>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Bảng</a>
                                <ul class="nav nav-second-level">
                                    @foreach($table as $key => $item)
                                        <?php 
                                            $slug = str_slug($item->name);
                                        ?>
                                        <li><a href="{{route('table.getid',['slug'=>$slug,'id'=>$item->id])}}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            
                            <li>
                                <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Quy trình</a>
                            </li>
                        @else
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
                        @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>