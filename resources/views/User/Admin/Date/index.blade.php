@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Ngày tháng') }}
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
									<label for="name-date">
										{{ __('Sự kiện') }}
									</label>
									<input type="text" placeholder="Tên sự kiện" class="form-control" name="date[name]" id="name-date">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày') }}
									</label>
									<input type="date" placeholder="Email" class="form-control" name="date[date]">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="status-date">
										{{ __('Trạng thái') }}
									</label>
									<input type="text" placeholder="select" class="form-control" id="status-date" name="date[status]" value="">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" name="bill[start_created_at]" value="">
										-
										<input type="date" placeholder="select" class="form-control" name="bill[end_created_at]" value="">
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
				<div class="col-md-6 p-0">
					<div class="card-header">
						<h4 class="card-title">
							{{ __('Thêm mới') }}
						</h4>
					</div>
					<div class="card-content">
						<a href="{{ route('admin.menu.add') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-menu"></i>
							{{ __('Thêm ngày tháng') }}
						</a>
					</div>
				</div>
			</div>
		</div>



		<div class="row">


			<div class="col-md-12 card">

				<div class="card-header">
					<h4 class="card-title">{{ __('Ngày tháng') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Sự kiện') }}</th>
									<th>{{ __('Ngày') }}</th>
									<th>{{ __('Giá tăng') }}</th>
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