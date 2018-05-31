<!DOCTYPE html>
<html lang="vi">
@include('templates.public.thems.layout.head')
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			@include('templates.public.thems.layout.header')
			@yield('sidebar')
		</nav>
		<div id="page-wrapper">
			<div class="content-wrapper">
			@yield('main')	
			</div>
		</div>
	</div>	
	@include('templates.public.thems.layout.footer')
</body>
</html>