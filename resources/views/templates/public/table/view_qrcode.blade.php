<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR-Code| VQS.VN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VQS - Viet Quality</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ $url_public }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ $url_public }}/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ $url_public }}/dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="{{ $url_public }}/dist/css/custom_style.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ $url_public }}/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ $url_public }}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        *{
            padding: 0px;
            margin: 0px;
        }
        body {
            font-weight: normal;
        }
        #wrapper_mb {
            width: 100%;
            background: #fff;
        }
       .table {
           width: 100%;
       }
       .table td {
           font-weight: normal;
       }
        .hearder {
            background: #2e3192;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        .content-wrapper {
            padding: 0px;
            padding: 0px 5px;
        }
        .name-table {
            border-bottom: 2px solid #2e3192;
            padding: 5px 0px;
        }
    </style>
</head>
<body>
    <div id="wrapper_mb">
        <div class="hearder">
            <h3>QR-Code - VQS.VN</h3>
        </div>
        <div class="content-wrapper">
            <div class="row">
                @foreach($data as $value)
                    <div class="col-lg-12 col-xs-12">
                        <h3 class="name-table">{{ $value['ten'] }}</h3>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                @foreach($value['collums'] as $item)
                                    <th>{{$item['name']}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody class="">
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
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{ $url_public }}/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ $url_public }}/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ $url_public }}/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ $url_public }}/vendor/raphael/raphael.min.js"></script>
    <script src="{{ $url_public }}/vendor/morrisjs/morris.min.js"></script>
    <script src="{{ $url_public }}/data/morris-data.js"></script>

</body>
</html>