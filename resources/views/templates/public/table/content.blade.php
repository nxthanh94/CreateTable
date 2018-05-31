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
              
   					</td>
   			</tr>
   		</table>
    </div> 
</div>

