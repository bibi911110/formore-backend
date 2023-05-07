<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>
	@yield('content')
	@yield('scripts')
</body>
</html>