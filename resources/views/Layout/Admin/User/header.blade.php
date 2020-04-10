<nav class="navbar navbar-default">
    <div class="container-fluid">
		<div class="navbar-minimize">
			<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
		</div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="{{ url()->current() }}" id="title_page">
				{{-- {{ __('Trang chủ') }} --}}
            </a>
        </div>
        <div class="collapse navbar-collapse">
			<form class="navbar-form navbar-left navbar-search-form" role="search">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" value="" class="form-control" placeholder="Search...">
				</div>
			</form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#stats" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
                        <i class="ti-panel"></i>
						<p>Stats</p>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                        <i class="ti-bell"></i>
                        <span class="notification">5</span>
						<p class="hidden-md hidden-lg">
							Notifications
							<b class="caret"></b>
						</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#not1">Notification 1</a></li>
                        <li><a href="#not2">Notification 2</a></li>
                        <li><a href="#not3">Notification 3</a></li>
                        <li><a href="#not4">Notification 4</a></li>
                        <li><a href="#another">Another notification</a></li>
                    </ul>
                </li>
				<li class="dropdown">
                    <a href="#" class="btn-rotate" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
						<i class="ti-settings"></i>
						<p class="hidden-md hidden-lg">
							{{ __('Điều chỉnh') }}
						</p>
                    </a>
                    <ul class="dropdown-menu">
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
                </li>
            </ul>
        </div>
    </div>
</nav>