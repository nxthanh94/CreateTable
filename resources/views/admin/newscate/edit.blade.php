@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <?php
    $id = $arCate['id'];
    $name = $arCate['name'];
    $status = $arCate['status'];
    $parent_id = $arCate['parent_id'];
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.newscate.edit',$id) }}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Select</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="cate">
                    <option value="0">Không</option>
                    <?php echo cate_parent($arItems,0,$str="",$arCate['parent_id']); ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text" value="{{ $name }}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                </label>
                <div class="radio">
                  <label>
                    <input type="radio" value="0" class="flat" @if($status == 0)checked @endif name="iCheck"> Show
                  </label>
                  <label>
                    <input type="radio" value="1" class="flat" @if($status == 1)checked @endif name="iCheck"> Hidden
                  </label>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection