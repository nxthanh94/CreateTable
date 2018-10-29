<script src="{{ $url_public }}/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ $url_public }}/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ $url_public }}/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ $url_public }}/vendor/raphael/raphael.min.js"></script>
    <script src="{{ $url_public }}/vendor/morrisjs/morris.min.js"></script>
    <script src="{{ $url_public }}/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ $url_public }}/dist/js/sb-admin-2.js"></script>
    <script src="{{ $url_public }}/dist/js/jquery.qrcode.js"></script>
    <script src="{{ $url_public }}/dist/js/qrcode.js"></script>
    <?php
        $id_user =0;
        if(Auth::check())
        {
            $id_user = Auth::user()->id;
        }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.click_addrow').click(function() {
                var token = '{{csrf_token()}}';
                var name_table = $(this).attr('data');
                var id_user = {{$id_user}};
                 jQuery.ajax({
                    type: 'POST',
                    url: "{{route('table.addrow')}}",
                    dataType:'json',
                    data: {name_table:name_table,id_user:id_user,_token:token},           
                    success: function(data) 
                    {                                       
                        if(data.value=='')
                        {
                                alert('Chưa tạo bảng cho dịch vụ này');
                        }
                        else
                        {
                                $('.content-body-table').append(data.value);
                                $('.last_stt').val(data.stt);
                        }
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
      function updatecollums(table,id,collums,value)
      {
          var _token = '{{csrf_token()}}';
          jQuery.ajax({
          type: 'POST',
          url: "{{route('table.updatecollums')}}",
                dataType:'json',
          data: {id:id,table:table,collums:collums,value:value,_token:_token},      
          success: function(data) {                   
              if(data.tb==0)
                        {
                            alert('Chưa cập nhập được dữ liệu');
                        }
            }
           });
      }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.copy_row').click(function(){
            var token = '{{csrf_token()}}';
            var id_table = $(this).attr('data');
            var stt = $('.last_stt').val();
             jQuery.ajax({
                    type: 'POST',
                    url: "{{route('table.copyrow')}}",
                    dataType:'json',
                    data: {id_table:id_table,stt:stt,_token:token},           
                    success: function(data) 
                    {                                       
                        if(data.value=='')
                        {
                                alert('Chưa tạo bảng cho dịch vụ này');
                        }
                        else
                        {
                                $('.content-body-table').append(data.value);
                                $('.last_stt').val(data.stt);
                        }
                    }
                });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.checkall').click(function() {
            if (jQuery(this).is(':checked')) {
                jQuery('.checkbox_item').each(function () {
                    this.checked = true;
                });
            } else {
                jQuery('.checkbox_item').each(function () {
                    this.checked = false;
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.del-rows').click(function() {
            var ar_id = new  Array();
            var token = '{{csrf_token()}}';
            var id_table = $(this).attr('data');
            $i = 0;
            jQuery('.checkbox_item').each(function () {
                if(jQuery(this).is(':checked'))
                {
                    ar_id[$i] = $(this).val();
                    $i = $i+1;
                }
            });
            
            jQuery.ajax({
                    type: 'POST',
                    url: "{{route('table.delrow')}}",
                    dataType:'json',
                    data: {id_table:id_table,id:ar_id,_token:token},           
                    success: function(data) 
                    {                                       
                        if(data.tb=='ok')
                        {
                           location.reload();    
                        }
                        else
                        {
                                alert(data.tb);
                        }
                    }
                });
            
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.qrcode-rows').click(function() {
            var ar_id = new  Array();
            var token = '{{csrf_token()}}';
            var id_table = $(this).attr('data');
            $i = 0;
            jQuery('.checkbox_item').each(function () {
                if(jQuery(this).is(':checked'))
                {
                    ar_id[$i] = $(this).val();
                    $i = $i+1;
                }
            });

            if(ar_id.length === 0 )
            {
                alert('Bạn chưa chọn row tạo QrCode!');
            }
            else
            {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{route('table.qrcode')}}",
                    dataType:'json',
                    data: {id_table:id_table,id:ar_id,_token:token},           
                    success: function(data) 
                    {                                       
                        if(data.tb=='ok')
                        {
                            $('.content-qrcode').html(data.img_qrcode);
                            $('.filter-table').attr('href', data.url_filter)
                            $('#qrcode_png').modal({
                                show: 'true'
                            }); 
                        }
                        else
                        {
                            alert(data.tb);
                        }
                    }
                 });
            }  
        });

        $(document).on('click','.save_img', function(){
            //var fs = require('fs');
            var img = $('.content-qrcode img').attr('src');
        });
    });
</script>
<!-- search -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_search').click(function(){
            var free_text = $('.free_text').val();
            var field_search = $('.field_search').val();
            var id_table = $(this).attr('data');
            var token = '{{ csrf_token() }}'
            if(free_text == null)
            {
                alert('bạn chưa nhập từ khoá');
            }
            else
            {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{route('table.search')}}",
                    dataType:'json',
                    data: {id_table:id_table,free_text:free_text,field_search:field_search,_token:token},           
                    success: function(data) 
                    {                                       
                        if(data.code==200)
                        {
                           $('.content-body-table').html(data.data);
                        }
                        else
                        {
                                alert(data.data);
                        }
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.filter_data').click(function () {
            var tableId = $(this).attr('data-table');
            var col = $('#col_'+tableId).val();
            var condition = $('#condition_'+tableId).val();
            var id = $(this).attr('data-id');
            var url = "{{ route('table.qrcodefilter') }}";
            var token = '{{ csrf_token() }}';

            jQuery.ajax({
                type: 'POST',
                url: url,
                dataType:'json',
                data: {id:id,col:col,condition:condition,tableId:tableId,_token:token},
                success: function(data) {
                    if (data.code == 200) {
                        $('#content_'+tableId).html(data.data_table);
                    }
                }
            });
        });
    });
</script>