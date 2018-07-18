<!DOCTYPE html>
<html>
<head>
	<title>New password</title>
</head>
<body>
	<h3>Chào bạn: {{$name}}</h3>
	<p>Pass word mới của bạn là: {{$content}}</p>
	<p>Bạn vui lòng <a href="{{route('login')}}">Đăng nhập</a></p>
</body>
</html>