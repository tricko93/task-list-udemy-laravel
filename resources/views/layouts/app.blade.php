{{--
	This layout file serves as the base template for all other views. It
	defines the basic HTML structure of the application, including the `<head>`
	section and the `<body>` section. The title of the page is rendered using
	the `@yield('title')` directive, and the actual content of each view is
	injected into the `@yield('content')` section. It provides a consistent
	structure and allows individual views to define their title and content
	sections.
--}}

<!DOCTYPE html>
<html>
	<head>
		<title>Laravel 10 Task List App</title>
	</head>

	<body>
		<h1>@yield('title')</h1>
		<div>
			@yield('content')
		</div>
	</body>
</html>
