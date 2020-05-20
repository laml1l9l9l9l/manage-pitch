@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Hóa đơn') }}
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
										{{ __('Khách hàng') }}
									</label>
									<input type="text" placeholder="Họ và tên" class="form-control" name="bill[name]" id="name-customer">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="status-bill">
										{{ __('Trạng thái') }}
									</label>
									<input type="text" placeholder="select" class="form-control" id="status-bill" name="bill[status]" value="">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="create-date-bill">
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" id="create-date-bill" name="bill[start_created_at]" value="">
										-
										<input type="date" placeholder="select" class="form-control" id="create-date-bill" name="bill[end_created_at]" value="">
									</div>
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
					<h4 class="card-title">{{ __('Hóa Đơn') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Khách hàng') }}</th>
									<th>{{ __('Tiền đặt cọc') }}</th>
									<th>{{ __('Thành tiền') }}</th>
									<th>{{ __('Trạng thái') }}</th>
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