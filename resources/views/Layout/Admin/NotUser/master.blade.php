<!DOCTYPE html>
<html lang="en">
<head>
	@include('Layout.Admin.head')
	@stack('css')
</head>

<body>

	@include('Layout.Admin.NotUser.header')
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="{{ asset('admin/img/background/background-2.jpg') }}">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
    					@yield('content')
                    </div>
                </div>
            </div>

	
			@include('Layout.Admin.NotUser.footer')
        	
        </div>
    </div>
</body>

@include('Layout.Admin.foot')
@stack('js')
<script type="text/javascript">
    $().ready(function(){
        custom.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</html>
