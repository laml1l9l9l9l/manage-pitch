<!DOCTYPE html>
<html lang="en">
<head>
	@include('Layout.Admin.head')
	@stack('css')
</head>

<body>
	<div class="wrapper">
	    <div class="sidebar" data-background-color="brown" data-active-color="danger">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo">
				<a href="{{ route('admin.home') }}" class="simple-text logo-mini">
					{{ __('MP') }}
				</a>

				<a href="{{ route('admin.home') }}" class="simple-text logo-normal">
					{{ __('Manager pitch') }}
				</a>
			</div>
	    	<div class="sidebar-wrapper">
				<div class="user">
	                <div class="photo">
	                    <img src="{{ asset('admin/img/faces/face-0.jpg') }}" />
	                </div>
	                <div class="info">
						<a data-toggle="collapse" href="#profile" class="collapsed">
	                        <span>
								Chet Faker
		                        <b class="caret"></b>
							</span>
	                    </a>
						<div class="clearfix"></div>

	                    <div class="collapse" id="profile">
	                        <ul class="nav">
	                            <li>
									<a href="{{ route('admin.profile') }}">
										<span class="sidebar-mini">
											<i class="ti-user"></i>
										</span>
										<span class="sidebar-normal">
											{{ __('Thông tin cá nhân') }}
										</span>
									</a>
								</li>
	                            <li>
									<a href="{{ route('admin.change.password') }}">
										<span class="sidebar-mini">
											<i class="ti-settings"></i>
										</span>
										<span class="sidebar-normal">
											{{ __('Đổi mật khẩu') }}
										</span>
									</a>
								</li>
	                            <li>
									<a href="{{ route('admin.logout') }}">
										<span class="sidebar-mini">
											<i class="ti-power-off"></i>
										</span>
										<span class="sidebar-normal">
											{{ __('Đăng xuất') }}
										</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </div>
	            </div>

	            {{-- Menu --}}
	            <ul class="nav">

	                <li>
	                    <a href="{{ route('admin.menu') }}">
	                        <i class="ti-menu"></i>
	                        <p>
	                        	{{ __('Menu') }}
	                        </p>
	                    </a>
	                </li>

					<li class="active">
	                    <a data-toggle="collapse" href="#dashboardOverview">
	                        <i class="ti-panel"></i>
	                        <p>
	                        	{{ __('Quản lý') }}
                                <b class="caret"></b>
                            </p>
	                    </a>
                        <div class="collapse in" id="dashboardOverview">
							<ul class="nav">
								<li class="sub-menu active">
									<a href="{{ route('admin.bill') }}">
										<span class="sidebar-mini">
											{{ __('HĐ') }}
										</span>
										<span class="sidebar-normal">
											{{ __('Hóa Đơn') }}
										</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.customer') }}">
										<span class="sidebar-mini">KH</span>
										<span class="sidebar-normal">Khách Hàng</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.pitch') }}">
										<span class="sidebar-mini">SB</span>
										<span class="sidebar-normal">Sân Bóng</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.date') }}">
										<span class="sidebar-mini">NT</span>
										<span class="sidebar-normal">Ngày Tháng</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.time') }}">
										<span class="sidebar-mini">TG</span>
										<span class="sidebar-normal">Thời Gian</span>
									</a>
								</li>
							</ul>
						</div>
	                </li>

	                <li>
	                    <a href="#">
	                        <i class="ti-shopping-cart"></i>
	                        <p>
	                        	{{ __('Căng Tin') }}
	                        </p>
	                    </a>
	                </li>

	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
	    	@include('Layout.Admin.User.header')

	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">

    					@yield('content')

	                </div>
	            </div>
	        </div>

	        
			@include('Layout.Admin.User.footer')
	    </div>
	</div>
	
</body>

@include('Layout.Admin.foot')
@stack('js')
<script type="text/javascript">
	$(document).ready(function(){
       	template_custom.getTitlePageCurrent();
	});
</script>

</html>
