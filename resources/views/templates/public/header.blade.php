<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Meta seo -->
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="revisit-after" content="1 days" />
    <link rel="canonical" href="{!! Request::url() !!}"/>
    <!-- Meta seo -->
    <!-- Schema.org markup for Google -->
    <meta itemprop="name" content="@yield('title')">
    <meta itemprop="description" content="@yield('description')">
    <meta itemprop="image" content="@yield('img')">
    <!-- end Schema.org markup for Google -->
    <!-- Open Graph data -->
    <meta property="og:title" content="@yield('title')" /> 
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{!! Request::url() !!}" /> 
    <meta property="og:image" content="@yield('img')" />
    <meta property="og:description" content="@yield('description')" /> 
    <meta property="og:site_name" content="Moc khoa" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="1873419896211314" />
    <!-- end Open Graph data -->
    <!-- Geo-Tags -->
    <meta name="DC.title" content="@yield('title')" />
    <meta name="geo.region" content="VN-DN" />
    <meta name="geo.placename" content="Da Nang" />
    <meta name="geo.position" content="16.061482;108.176646" />
    <meta name="ICBM" content="16.061482, 108.176646" />
    <link href="{{ $url_public }}/img/bower-logo.png" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ $url_public }}/bootsrap/css/bootstrap.min.css" rel="stylesheet">   
    <link rel="stylesheet" href="{{ $url_public }}/font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link  href="{{ $url_public }}/css/style.css" rel="stylesheet">

    <script src="{{ $url_public }}/js/slider-menu.js"></script>
    <script src="{{ $url_public }}/js/dd-menu.js"></script>   
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="{{ $url_public }}/bootsrap/js/bootstrap.min.js"></script>
    <script src="{{ $url_public }}/js/main.js"></script>
    <script type="text/javascript">
        function addPeriod(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }
        $(document).ready(function(){
            $('.bntt').click(function(){
                var id = $(this).attr('data');
                var tong =$('.'+id).val();
                var step = parseInt(tong) + 1;
                var gia = $(this).parent().parent().parent().find('.gt-product').attr('data');
                var gia_total = step*gia;
                var output = addPeriod(gia_total);
                $('.'+id).val(step);
                $(".gt-product").html(output);
            });
            $('.bntg').click(function(){
                var id = $(this).attr('data');
                var tong =$('.'+id).val();
                if(parseInt(tong)>=1)
                {
                    var step = parseInt(tong) - 1;
                    var gia = $(this).parent().parent().parent().find('.gt-product').attr('data');
                    var gia_total = step*gia;
                    var output = addPeriod(gia_total);
                    $('.'+id).val(step);
                    $(".gt-product").html(output);
                }
                else
                {
                    var step = 0;
                    $('.'+id).val(step);
                }
            }); 
        });
    </script>
    <script type="text/javascript">
        function addPeriod(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }
        $(document).ready(function(){
            $('.cart-bntt ').click(function(event) {
                event.preventDefault();
                var rowid = $(this).attr('id');
                var token = $("input[name='_token']").val();
                var id = $(this).attr('data');
                var tong =$('.'+id).val();
                var qty = parseInt(tong) + 1;
                var gia = $(this).parent().parent().parent().find('.gia_cart').attr('data');
                var gia_total = qty*gia;
                var output = addPeriod(gia_total);
                $('.'+id).val(qty);

                $.ajax({
                    url: '/cap-nhat-san-pham/'+rowid+'/'+qty,
                    type: 'GET',
                    cache: false,
                    data:{
                        _token:token,
                        id:rowid,
                        qty:qty,
                    },
                    success: function(data){
                        window.location = '/gio-hang'
                    }
                });

            });
            $('.cart-bntg').click(function(){
                var rowid = $(this).attr('id');
                var token = $("input[name='_token']").val();
                var id = $(this).attr('data');
                var tong =$('.'+id).val();
                var qty = parseInt(tong) - 1;
                var gia = $(this).parent().parent().parent().find('.gia_cart').attr('data');
                var gia_total = qty*gia;
                var output = addPeriod(gia_total);
                $('.'+id).val(qty);

                $.ajax({
                    url: '/cap-nhat-san-pham/'+rowid+'/'+qty,
                    type: 'GET',
                    cache: false,
                    data:{
                        _token:token,
                        id:rowid,
                        qty:qty,
                    },
                    success: function(data){
                        window.location.href  = '/gio-hang'
                    }
                });
            }); 
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function($) {    
            $(window).scroll(function(){
                if($(this).scrollTop()>90){
                    $(".content").css({"position":"fixed","z-index":"100","background":"#fff","top":"0","width":"calc(100% - 30px)"});
                }
                else{
                    $(".content").css({"position":"relative","z-index":"100","width":"100%"});
                }
            }
            )
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#input_code').change(function(event) {
                event.preventDefault();
                $('.loader').show();
                $('.fa-check').hide();
                var makhuyenmai = $("input[name='makhuyenmai']").val();
                if(makhuyenmai != ''){
                    $.ajax({ 
                        url : '/key-code',
                        type: 'GET', 
                        cache: false,
                        dataType: 'json',
                        data: {
                            makhuyenmai:makhuyenmai,
                        },
                        success: function(data) {
                            if(data['dem'] == 0){
                                $("#myform").attr('action', '{{ route("public.sanpham.info") }}');
                                $('.fa-check').show();
                                $('.loader').hide();
                                var gia = "<?php echo Cart::subtotal(0,'',''); ?>";
                                var soluong = data['soluong'];
                                var giagiam = (gia - (gia*soluong/100)).toFixed(0);
                                var output = addPeriod(giagiam);
                                $('.giamgiatotal').text(output);
                            }
                            if(data['dem'] != 0){
                                $("#myModal").modal();
                                $('.loader').hide();
                                var gia = "<?php echo Cart::subtotal(0,'',''); ?>";
                                var output = addPeriod(gia);
                                $('.giamgiatotal').text(output);
                                $("#myform").attr('method', 'get');
                                $("#myform").attr('action', '{{ route("public.sanpham.giohang") }}');
                            }
                        },
                    });
                }else{
                    $('.loader').hide();
                    var gia = "<?php echo Cart::subtotal(0,'',''); ?>";
                    var output = addPeriod(gia);
                    $('.giamgiatotal').text(output);
                }

            });
        });
    </script>

</head>
<body>