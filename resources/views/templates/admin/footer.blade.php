 <!-- footer content -->
 <footer>
  <div class="pull-right">
    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
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
<script type="text/javascript">
    $(document).ready(function(){
        var h = document.getElementById("right_col").offsetHeight;
        var l = document.getElementById("left_col").offsetHeight;
        document.getElementById("right_col").style.minHeight = l + "px";
    });
</script>

</body>
</html>