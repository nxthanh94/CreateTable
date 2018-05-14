@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.news.add') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">Name</label>
                      <div class="col-md-11 col-sm-11 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-1 col-sm-1 col-xs-12">Select</label>
                      <div class="col-md-11 col-sm-11 col-xs-12">
                        <select class="form-control" name="cate">
                          <option value="0">Không</option>
                          <?php echo cate_parent($arCate,0,$str="",old('cate')); ?>
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="textarea">Preview</label>
                      <div class="col-md-11 col-sm-11 col-xs-12">
                        <textarea id="textarea" required="required" name="preview" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="textarea">Detail</label>
                      <div class="col-md-11 col-sm-11 col-xs-12">
                        <textarea id="textarea" required="required" name="detail" class="form-control col-md-7 col-xs-12"></textarea>
                        <script>
                         CKEDITOR.replace('detail');
                       </script>
                     </div>
                   </div>
                   <div class="item form-group">
                    <div class="col-md-offset-1 col-md-11 col-sm-11 col-xs-12">
                      <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="title" placeholder="Title" required="required" type="text">
                    </div>
                  </div>
                  <div class="item form-group">
                    <div class="col-md-offset-1 col-md-11 col-sm-11 col-xs-12">
                      <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="keywords" placeholder="Keywords" required="required" type="text">
                    </div>
                  </div>
                  <div class="item form-group">
                    <div class="col-md-offset-1 col-md-11 col-sm-11 col-xs-12">
                      <textarea id="textarea" required="required" name="description" class="form-control col-md-7 col-xs-12">Description</textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="row">
                  <div class="x_title">
                    <h2 style="font-size: 16px;">Status (*)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li style="float: right;"><a class="collapse-link"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="item form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" value="0" class="flat" checked name="iCheck"> Show
                        </label>
                        <label>
                          <input type="radio" value="1" class="flat" name="iCheck"> Hidden
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="x_panel">
                <div class="row">
                  <div class="x_title">
                    <h2 style="font-size: 16px;">Picture(*)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li style="float: right;"><a class="collapse-link"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="item form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="file" name="picture">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="x_panel">
                <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                    <button type="submit" class="btn btn-primary">Cancel</button>
                  </div>
                </div>
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