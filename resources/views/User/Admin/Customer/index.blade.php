@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Khách hàng') }}
	</title>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-12 card">
				<form action="" method="GET">
					<div class="col-md-12 p-0">
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Tìm kiếm') }}
							</h4>
						</div>
						<div class="row card-content card-form-input collapse" id="form-search">
							<div class="col-md-4">
								<div class="form-group">
									<label for="name-customer">
										{{ __('Họ và tên') }}
									</label>
									<input type="text" placeholder="Họ và tên" class="form-control" name="customer[name]" id="name-customer">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="email-customer">
										{{ __('Email') }}
									</label>
									<input type="text" placeholder="Email" class="form-control" name="customer[email]" id="email-customer">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="icon-menu">
										Icon menu
									</label>
									<input type="text" placeholder="VD: ti-panel" class="form-control" id="icon-menu" name="bill[icon]" value="">
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<button class="btn btn-fill btn-wd" id="btn-reset" type="reset">
									<i class="ti-reload"></i>
									{{ __('Làm mới') }}
								</button>
							</div>
							<div class="form-btn">
								<a href="#form-search" class="btn btn-info btn-fill btn-wd collapsed" id="btn-expand" data-toggle="collapse">
									<i class="ti-angle-down"></i>
									{{ __('Mở rộng') }}
								</a>
							</div>
							<div class="form-btn">
								<button class="btn btn-primary btn-fill btn-wd" type="submit">
									<i class="ti-search"></i>
									{{ __('Tìm kiếm') }}
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>

		<div class="row">


			<div class="col-md-12 card">

				<div class="card-header">
					<h4 class="card-title">{{ __('Khách Hàng') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Tài khoản') }}</th>
									<th>{{ __('Họ tên') }}</th>
									<th>{{ __('Email') }}</th>
									<th>{{ __('Số điện thoại') }}</th>
									<th>{{ __('Ngày tạo') }}</th>
									<th class="text-center">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								{{-- Dữ liệu --}}
							</tbody>
						</table>
					</div>

					<div class="text-right">
						{{-- Phân trang --}}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection