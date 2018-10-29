<form action="{{ $routeAction }}" method="post">
    {{ csrf_field() }}
    <div class="">
        <div class="row">
            @foreach($data as $keyTable => $value)
                <div class="col-lg-12 col-xs-12">
                    <h3 class="name-table"><button data-toggle="modal" data-target="#modal_filter_{{ $keyTable }}" type="button" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i></button>{{ $value['ten'] }}</h3>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            @foreach($value['collums'] as $item)
                                <th>{{$item['name']}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody id="content_{{ $value['tableId'] }}">
                        @foreach($value['items'] as $key => $item)
                            @php($item = (array) $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                @foreach($value['collums'] as $collums)
                                    <td>{{$item[$collums['label']]}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="modal_filter_{{ $keyTable }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Lọc dữ liểu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Chọn trường</label>
                                    <select name="table[{{ $value['tableId'] }}][col]" class="form-control" id="col_{{ $value['tableId'] }}">
                                        @foreach($value['collums'] as $item)
                                            @if($item['type'] == 'date')
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Điều kiện</label>
                                    <input type="text" name="table[{{ $value['tableId'] }}][condition]" class="form-control" id="condition_{{ $value['tableId'] }}" placeholder="yyyy/mm/dd:yyyy/mm/dd|yyyy/mm/dd,yyyy/mm/dd">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" data-id="{{ $value['id'] }}" data-table="{{ $value['tableId'] }}" class="btn btn-primary filter_data">Lọc dữ liệu</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12">
                <button class="btn btn-primary" type="submit">Xuất QR-CODE</button>
            </div>
        </div>
    </div>
</form>