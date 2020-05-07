<ul class="nav">

	<li>
		<a href="{{ route('admin.menu') }}">
			<i class="ti-menu"></i>
			<p>
				{{ __('Menu') }}
			</p>
		</a>
	</li>
	<li>
		<a href="{{ route('admin.menu') }}">
			<i class="ti-menu"></i>
			<p>
				{{ __('Quyền quản trị') }}
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