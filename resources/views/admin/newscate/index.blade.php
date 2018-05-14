@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>



    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List</h2><br />
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
            @if( Session::get('msg') != '')
            <p style="color: red">{{ Session::get('msg') }}</p>
            @endif
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              <a href="{{ route('admin.newscate.add') }}" class="btn btn-success btn-md"></i> Add </a>
            </p>
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th style="text-align: center;">Status</th>
                  <th style="text-align: center;">Edit</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $id = $arItem['id'];
                $name = $arItem['name'];
                $status = $arItem['status'];
                $urlDel = route('admin.newscate.del', $id);
                $urlEdit = route('admin.newscate.edit', $id);
                ?>
                <tr>
                  <td>{{ $name }}</td>
                  @if($status == 0)
                  <td>
                    <a href="{{ route('admin.newscate.status', ['id' => $id, 'status' => $status])}}">
                      <center><img src="{{ $url_admin }}/images/tick.png"></center>
                    </a>
                  </td>
                  @else
                  <td >
                    <a href="{{ route('admin.newscate.status', ['id' => $id, 'status' => $status])}}">
                      <center><img src="{{ $url_admin }}/images/publish_x.png"></center>
                    </a>
                  </td> 
                  @endif
                  <td style="text-align: center;">
                    <a href="{{ $urlEdit }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="{{ $urlDel }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc muốn xóa không ?');"><i class="fa fa-trash-o"></i> Delete </a>
                  </td>
                </tr>
                @foreach($chilren as $key => $chil)
                <?php
                $id1 = $chil['id'];
                $name1 = $chil['name'];
                $status1 = $chil['status'];
                $urlDel1 = route('admin.newscate.del', $id1);
                $urlEdit1 = route('admin.newscate.edit', $id1);
                ?>
                @if($arItem['id'] == $chil['parent_id'])
                <tr>
                  <td>--|{{ $name1 }}</td>
                  @if($status1 == 0)
                  <td>
                    <a href="{{ route('admin.newscate.status', ['id' => $id1, 'status' => $status1])}}">
                      <center><img src="{{ $url_admin }}/images/tick.png"></center>
                    </a>
                  </td>
                  @else
                  <td >
                    <a href="{{ route('admin.newscate.status', ['id' => $id1, 'status' => $status1])}}">
                      <center><img src="{{ $url_admin }}/images/publish_x.png"></center>
                    </a>
                  </td> 
                  @endif
                  <td style="text-align: center;">
                    <a href="{{ $urlEdit1 }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="{{ $urlDel1 }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn chắc muốn xóa không ?');"><i class="fa fa-trash-o"></i> Delete </a>
                  </td>
                </tr>
                @endif
                @endforeach
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>







    </div>
  </div>
</div>
<!-- /page content -->
@endsection