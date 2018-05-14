<header id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-sm-5 col-md-8">
                <div class="head-menu-x">
                    <ul>
                        <li class="title-menu">MENU</li>
                        <li class="but-menu">
                            <button id="open-menu" class="open-menu poen">
                                <i class="fa fa-bars"></i>
                            </button>
                        </li>                               
                    </ul>                           
                </div>
                <div id="dd-menu" class="dd-menu level-1" data-button="#open-menu">
                    <div class="dd-menu-header">
                        <a href="/" class="dd-menu-title">Xe Ra Di</a>
                        <button class="dd-menu-close">&times;</button>
                    </div>
                    <!--<div class="dd-menu-section"></div>-->
                    <ul id="accordion" class="accordion">
                        <?php 
                        $Menu = DB::table('hangsx')->where('id_danhmuc','=',1)->orderBy('id','desc')->get();
                        ?>
                        @foreach($Menu as $key => $MN)
                        <?php 
                        $name = $MN['tenhsx'];
                        $id = $MN['id'];
                        $nameSeo = str_slug($name);
                        $url = route('public.sanpham.tcsanpham',['slug' => $nameSeo,'id' => $id]);
                        ?>
                        <li>
                            <div class="link"><i class="fa fa-circle-o-notch mobi-m"></i>{{$name}}<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu">
                                <?php 
                                $Menu1 = DB::table('hangsx')->where('id_danhmuc','=',$MN['id'])->where('stt','=',1)->orderBy('id','desc')->get();
                                ?>
                                @foreach($Menu1 as $key => $MN1)
                                <?php 
                                $name1 = $MN1['tenhsx'];
                                $id1 = $MN1['id'];
                                $nameSeo1 = str_slug($name1);
                                $url1 = route('public.sanpham.tcsanpham',['slug' => $nameSeo1,'id' => $id1]);
                                ?>
                                <li><a href="{{$url1}}">{{$name1}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                        <li>
                            <div class="link landing-link"><i class="fa fa-gift"></i>Nhận Quà Tặng<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu">
                                <?php 
                                $arNhanqua = DB::table('nhanqua')->orderBy('id','desc')->get();
                                ?>
                                @foreach($arNhanqua as $key => $nhanqua)
                                <?php 
                                $name = $nhanqua['name'];
                                $nameSeo = str_slug($name);
                                ?>
                                <li><a href="{{ route('public.lienhe.makhuyenmai',['slug' => $nameSeo ,'id' => $nhanqua['id'] ]) }}">{{ $nhanqua['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6 col-sm-7 col-md-4">
                <div class="row">
                    <div class="col-4 col-md-6 page-right">
                        <div class="logo">
                            <a href="/" >
                                <img src="{{ $url_public }}/img/bower-logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 page-right">
                        <div class="giohang-home">
                            <a href="{{ route('public.sanpham.giohang') }}" >
                                <?php 
                                $spgiohang = Cart::count();
                                ?>
                                <i class="fa fa-shopping-cart"><sub class="loadGH" @if($spgiohang == 0) style="display: none;" @endif><?php echo Cart::count() ?></sub></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="morong-home">
                            <a href="{{ route('public.lienhe.index') }}"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="content">
                    <div class="menu_slider">
                        <?php 
                        $Menu1 = DB::table('hangsx')->where('id_danhmuc','=',1)->get();
                        ?>
                        @foreach($Menu1 as $key => $MN)
                        <?php
                        $Menu2 = DB::table('hangsx')->where('id_danhmuc','=',$MN['id'])->where('stt','=',1)->orderBy('id','desc')->get();
                        ?>
                        @foreach($Menu2 as $key => $MN1)
                        <?php 
                        $name1 = $MN1['tenhsx'];
                        $id1 = $MN1['id'];
                        $nameSeo1 = str_slug($name1);
                        $url1 = route('public.sanpham.tcsanpham',['slug' => $nameSeo1,'id' => $id1]);
                        ?>
                        <a href="{{ $url1 }}">{{ $name1 }}</a>
                        @endforeach
                        @endforeach
                        <div class="btn-op btn_left" onclick="menu_scroll('left')"><span class="rightleft"><i class="fa fa-angle-left"></i></span></div>
                        <div class="btn-op btn_right" onclick="menu_scroll('right')"><span class="rightleft"><i class="fa fa-angle-right"></i></span></div>
                        <input type="hidden" id="num_menu" name="num_menu" value="0">
                    </div>
                </div>
            </div><!-- End menu silder -->
        </div>
    </div>
</header><!-- /header -->