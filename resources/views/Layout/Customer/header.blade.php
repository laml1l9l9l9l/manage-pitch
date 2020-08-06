<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<div class="container">
    	<!-- Brand and toggle get grouped for better mobile display -->
    	<div class="navbar-header">
    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
        		<span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
    		</button>
    		<a class="navbar-brand" href="{{ route('customer.home') }}" title="{{ __('Trang chủ') }}">
				<img src="{{ asset('custom/img/logo_transparent.png') }}" alt="Logo" width="80px">
    		</a>
    	</div>

    	<div class="collapse navbar-collapse">
    		<ul class="nav navbar-nav navbar-right">

                @if(Auth::guard('web')->check())
					{{-- <li>
						<a href="{{ route('customer.queue.bill') }}">
							<i class="material-icons">book</i> {{ __('Hóa đơn tạm') }}
						</a>
					</li> --}}
					<li>
						<a href="{{ route('customer.bill') }}">
							<i class="material-icons">assignment</i> {{ __('Hóa đơn') }}
						</a>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">account_box</i> {{ __('Cá Nhân') }}
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="{{ route('customer.profile') }}">
									<i class="material-icons">account_circle</i> {{ __('Thông tin cá nhân') }}
								</a>
							</li>
							<li>
								<a href="{{ route('customer.profile.change.password') }}">
									<i class="material-icons">settings</i> {{ __('Đổi mật khẩu') }}
								</a>
							</li>
							<li>
								<a href="{{ route('customer.logout') }}">
									<i class="material-icons">power_settings_new</i> {{ __('Đăng xuất') }}
								</a>
							</li>
						</ul>
					</li>
				@else
					<li>
						<a href="{{ route('customer.login') }}" title="{{ __('Đăng nhập') }}">
							<i class="material-icons">person</i> Đăng nhập
						</a>
					</li>
					<li>
						<a href="{{ route('customer.register') }}" title="{{ __('Đăng ký') }}">
							<i class="material-icons">list_alt</i> Đăng ký
						</a>
					</li>
				@endif
    		</ul>
    	</div>
	</div>
</nav>