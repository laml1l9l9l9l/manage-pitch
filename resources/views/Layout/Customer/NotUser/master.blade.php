<!DOCTYPE html>
<html lang="en">
<head>
	@include('Layout.Customer.head')
	@stack('css')
</head>

<body>

    @include('Layout.Customer.header')

	<div class="login-page">

		<div class="page-header header-filter" style="background-image: url({{ asset('custom/img/bg-new-1.jpg') }}); background-size: cover; background-position: top center;">
			<div class="container">
    			@yield('content')
    		</div>
    		@include('Layout.Customer.footer')
    	</div>
    </div>

	@include('Layout.Customer.foot')
	@stack('js')

</body>
</html>
