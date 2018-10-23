 <!-- footer content -->
 <footer>
  <div class="pull-right">
    Product by <a href="http://ngoisaovietmedia.com/">Vietstar Media</a>
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="{{ $url_admin }}/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ $url_admin }}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ $url_admin }}/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="{{ $url_admin }}/vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="{{ $url_admin }}/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="{{ $url_admin }}/vendors/validator/validator.js"></script>
<!-- iCheck -->
<script src="{{ $url_admin }}/vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="{{ $url_admin }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

<script src="{{ $url_admin }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>

<script src="{{ $url_admin }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ $url_admin }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<script src="{{ $url_admin }}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="{{ $url_admin }}/vendors/jszip/dist/jszip.min.js"></script>

<script src="{{ $url_admin }}/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ $url_admin }}/vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ $url_admin }}/vendors/moment/min/moment.min.js"></script>
<script src="{{ $url_admin }}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{ $url_admin }}/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="{{ $url_admin }}/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="{{ $url_admin }}/vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="{{ $url_admin }}/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="{{ $url_admin }}/vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="{{ $url_admin }}/vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="{{ $url_admin }}/vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="{{ $url_admin }}/vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="{{ $url_admin }}/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="{{ $url_admin }}/vendors/starrr/dist/starrr.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{ $url_admin }}/build/js/custom.min.js"></script>
 <link href="{{ $url_admin }}/build/js/select2.js" rel="stylesheet">
 @php (!empty($users) ? $dataSelect = $users : $dataSelect = [] )
 <script type="text/javascript">
     $('#tags').select2({
         data: <?php echo(json_encode($dataSelect)) ?>,
         tags: true,
         tokenSeparators: [','],
         placeholder: "Add your tags here"
     });
 </script>
<script type="text/javascript">
    $('.add-collum').click(function(){
      var html = $('.content-frm-collum').html();
      var stt_o = $('.content-frm-collum .content-stt').html();
      var stt = parseInt(stt_o)+1;
      $('.content-frm-collum .content-stt').html(stt);
      $('.content-add-collums').append(html);
    });
</script>
<script type="text/javascript">
	$('.get_table').change(function() {
		var id_sevice = $(this).val();
		 var token = $("input[name='_token']").val(); 
		 jQuery.ajax({
			type: 'POST',
			url: "{{route('admin.collums.ajaxtable')}}",
            dataType:'json',
			data: {id_sevice:id_sevice,_token:token},			
			success: function(data) {										
					if(data.value==0)
                    {
                        alert('Chưa tạo bảng cho dịch vụ này');
                    }
                    else
                    {
                    	$('.show_table').html(data.value);
                    }
				}
		   });
	});
</script>
<script type="text/javascript">
  function change_value(table,id,collums,value)
  {
      var _token = '{{csrf_token()}}';
      jQuery.ajax({
      type: 'POST',
      url: "{{route('admin.collums.ajaxchangevalue')}}",
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
  function change_value_process(id_process,id)
  {
      var _token = '{{csrf_token()}}';
      jQuery.ajax({
      type: 'POST',
      url: "{{route('admin.process.changevalueajax')}}",
            dataType:'json',
      data: {id_process:id_process,id:id,_token:_token},      
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
  function adduser(id_user,id)
  {
      var _token = '{{csrf_token()}}';
      jQuery.ajax({
      type: 'POST',
      url: "{{route('admin.table.adduserajax')}}",
            dataType:'json',
      data: {id_user:id_user,id:id,_token:_token},      
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
  function addservice(id,id_service)
  {
      var _token = '{{csrf_token()}}';
      jQuery.ajax({
      type: 'POST',
      url: "{{route('admin.user.addservice')}}",
            dataType:'json',
      data: {id_service:id_service,id:id,_token:_token},      
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
  $('.check_value').click(function() {
    var id = $(this).val();
    var id_group;
    if($(this).prop('checked')==true)
    {
      id_group = $(this).attr('data');
    }
    else
    {
      id_group = null;
    }
    change_value('collums',id,'id_group',id_group);
  });
</script>
<script type="text/javascript">
  $('.filter_table').change(function() {
    var id = $(this).val();
    if(id=="null")
    {
      $('.item_table').show();
    }
    else
    {
       $('.item_table').hide();
       $('.show_'+id).show();
    }
  });
</script>
<script type="text/javascript">
  $('.check_value_process').click(function() {
    var id = $(this).val();
    var id_process =$(this).attr('data');
    change_value_process(id_process,id);
  });
</script>
<script type="text/javascript">
  $('.adduser').click(function() {
    var id_user = $(this).val();
    var id =$(this).attr('data');
    if(id!='')
    {
      adduser(id_user,id);
    }
    
  });
</script>
<script type="text/javascript">
  $('.addservice').click(function() {
    var id_service = $(this).val();
    var id =$(this).attr('data');
    if(id!='')
    {
      addservice(id,id_service);
    }
    
  });
</script>
<!-- Load Facebook SDK for JavaScript -->
<script type="text/javascript">
  $('.ck_editor').parent('.formRight').css({width:'100%','margin-top':'30px','float':'none'});
  $('.ck_editor').each(function(index, el) {
    var id=$(this).attr('id');
    CKEDITOR.replace( id, {
    height : 400,
    entities: false,
        basicEntities: false,
        entities_greek: false,
        entities_latin: false,
    skin:'office2013',
    filebrowserBrowseUrl : '../assets/templates/admin/js/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '../assets/templates/admin/js/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '../assets/templates/admin/js/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : '../assets/templates/admin/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '../assets/templates/admin/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '../assets/templates/admin/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    allowedContent:
      'h1 h2 h3 p blockquote strong em;' +
      'a[!href];' +
      'img(left,right)[!src,alt,width,height];' +
      'table tr th td caption;' +
      'span{!font-family};' +
      'span{!color};' +
      'span(!marker);' +
      'del ins'
    });

  });
  
</script>
 @yield('js')
 <script type="text/javascript">
     $(document).ready(function(){
         var h = document.getElementById("right_col").offsetHeight;
         var l = document.getElementById("left_col").offsetHeight;
         document.getElementById("right_col").style.minHeight = l + "px";
     });
 </script>
</body>
</html>