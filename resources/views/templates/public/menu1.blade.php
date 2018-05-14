<header class="menu-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-sm-4 col-md-3">
                <div class="icon-menu-2">
                    <a href="javaScript:window.history.back();"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                </div>
            </div> 
            <div class="col-3 col-sm-4 col-md-6">
                <div class="logo-2">
                    <a href="/">
                        <img src="{{ $url_public }}/img/bower-logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3">
                <div class="row">
                    <div class="col-8 col-md-7">
                        <div class="icon-2">
                            <a href="{{ route('public.sanpham.giohang') }}" >
                                <?php 
                                $spgiohang = Cart::count();
                                ?>
                                <i class="fa fa-shopping-cart"><sub class="loadGH" style="@if($spgiohang == 0) display: none;@endif margin-top: 15px;"><?php echo Cart::count() ?></sub></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-5 padright-2">
                        <div class="car-2">
                            <a href="{{ route('public.lienhe.index') }}" >
                                <i class="fa fa-th"></i>
                            </a>
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