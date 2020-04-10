<!DOCTYPE html>
<html lang="en">
<head>
	@include('Layout.Customer.head')
	@stack('css')
</head>

<body>

    @include('Layout.Customer.header')

    @yield('content')

	@include('Layout.Customer.foot')
	@stack('js')

</body>
</html>
