<!-- Modal -->
<div class="modal fade" id="qrcode_png" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">QrCode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body content-qrcode">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$title}}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
   		<table class="table table-striped">
   			<thead class="thead-dark">
   				<tr>
   					<th><input type="checkbox" class="checkbox checkall"  name="checkall"></th>
   					<th>STT</th>
   					@foreach($collums as $item)
   						<th>{{$item['name']}}</th>
   					@endforeach
   				</tr>
   			</thead>
   			<tbody class="content-body-table">
   				{!! $rows !!}
   			</tbody>
   			<tr>
   					<td><input class="checkall checkbox" type="checkbox" name="" value="1"></td>
   					<td><input class="last_stt text_stt" type="text" name="" value="{{$stt}}"></td>
   					<td colspan="{{count($collums)}}">
   						<?php
                $id_table = $table_info['id'];
                $slug_table = str_slug($table_info['name']);
              ?>
   						<button class="btn btn-secondary copy_row" data="{{$id_table}}">Copy hàng</button>
   						<button class="btn btn-primary click_addrow" data="{{$id_table}}">Thêm hàng</button>
   						<button type="button" data="{{$id_table}}" class="btn btn-danger del-rows">Xoá</button>
              <a href="{{route('table.viewtable',['slug'=>$slug_table,'id'=>$id_table])}}"  data="{{$id_table}}" class="btn btn-info">Xem bảng</a>
              <a href="{{route('table.exportexcel',['slug'=>$slug_table,'id'=>$id_table])}}"  data="{{$id_table}}" class="btn btn-info">Export</a>
              <a href="{{route('table.exportpdf',['slug'=>$slug_table,'id'=>$id_table])}}"  data="{{$id_table}}" class="btn btn-info">Exprot pdf</a>
              <button type="button" data="{{$id_table}}" class="btn btn-danger qrcode-rows">Tạo QrCode</button>
              
   					</td>
   			</tr>
   		</table>
    </div> 
</div>