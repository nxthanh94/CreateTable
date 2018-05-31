<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi" xml:lang="vi" pdf:lang="vi">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<link href="{{ $url_public }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
	</style>
</head>
<body style="font-family:Times-New-Roman!important;">
	<article>
		{!!$content!!}
	</article>
</body>
</html>