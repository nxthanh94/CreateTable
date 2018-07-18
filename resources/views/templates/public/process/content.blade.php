<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$title}}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <article>
            {!!$process_info['content']!!}
            <p>Danh sách biểu mẩu</p>
            <ul>
            	@foreach($table_pro as $item)
				<?php 
                    $slug = str_slug($item->name);
                ?>
                    <li>Biểu mẫu: <a href="{{route('table.getid',['slug'=>$slug,'id'=>$item->id])}}">{{ $item->name }}</a></li>
            	@endforeach
            </ul>
        </article>
    </div> 
</div>
<div class="row">
    <div class="col-lg-12 padding">
        <a class="" href="{{ $create_pdf }}">Xuất PDF</a>
    </div>
    <!-- /.col-lg-12 -->
</div>