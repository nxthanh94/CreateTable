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
   						
   						<button class="btn btn-secondary copy_row" data="{{$table_info['id']}}">Copy hàng</button>
   						<button class="btn btn-primary click_addrow" data="{{$table_info['id']}}">Thêm hàng</button>
   						<button type="button" data="{{$table_info['id']}}" class="btn btn-danger del-rows">Xoá</button>
   					</td>
   			</tr>
   		</table>
    </div> 
</div>

