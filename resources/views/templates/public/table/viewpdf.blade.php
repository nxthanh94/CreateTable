<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi" xml:lang="vi" pdf:lang="vi">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<link href="{{ public_path() }}/css/bootstrap.min.css" rel="stylesheet">
	<title>{{$title}}</title>
	<style type="text/css">
		@font-face {
		    font-family: Times-New-Roman;
		    src: url("{{ asset('fonts/times.ttf') }}");
		    font-weight: normal;
		}
		@font-face {
            font-family: Times-New-Roman;
            src: url("{{ asset('fonts/timesbd.ttf') }}");
            font-weight: bold;
        }
		td, th {
			padding: 5px 10px;
		}
		th {
			text-align: center;
		}
		.title {
			padding: 5px: 0px;
			border-bottom: 1px solid #000;
			width: 100%;
			margin-bottom: 30px;
		}
	</style>
</head>
<body style="font-family:Times-New-Roman!important;">
	<h3 class="title">{{ $table_info['name'] }}</h3>
	<article style="margin-top:30px">
		{!!$content!!}
	</article>
</body>
</html>