 <div class="navbar-default sidebar" role="navigation">
                <div class="header-left"><h3 class="title_sidebar"><a href="#">
                @if(Auth::check())
                CHỌN XEM QUY TRÌNH HOẶC NHẬP LIỆU
                @else
                CHỌN DỊCH VỤ ĐANG ÁP DỤNG
                @endif
                </a></h3></div>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

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
                                            ->join('process','table.id_process','=','process.id')
                                            ->where('process.id_user','=',$id_user)
                                            ->select('table.*')->get();
                                }
                                
                            ?>
                            <li>
                                <?php
                                if($id_phanquyen == 1 || $id_phanquyen ==2)
                                {
                                    $process = DB::table('process')->get(); 
                                }
                                else
                                {
                                   $process = DB::table('process')->where('id_user',$id_user)->get(); 
                                }
                                    
                                ?>
                                <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Quy trình</a>
                                <ul class="nav nav-second-level">
                                    @foreach($process as $key => $item)
                                        <?php 
                                            $slug = str_slug($item->name);
                                            $id_user_process = $item->id_user;
                                        ?>
                                        <li><a href="{{route('process.getid',['slug'=>$slug,'id'=>$item->id])}}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
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
                            
                            
                        @else
                            @foreach($service as $item)
                            <li>
                                <a href="{{ route('login') }}">{{$item['service_cat']['name']}}<span class="fa arrow"></span></a>
                                @if(count($item['newsservice'])>0)
                                <ul class="nav nav-second-level">
                                    @foreach($item['newsservice'] as $value)
                                    <li>
                                        <?php
                                            $slug = str_slug($value['name']);
                                        ?>
                                        <a href="{{ route('login') }}">{{$value['name']}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                <!-- /.nav-second-level -->
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            