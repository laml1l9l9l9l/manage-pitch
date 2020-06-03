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
									<label for="phone-customer">
										{{ __('Số điện thoại') }}
									</label>
									<input type="text" placeholder="Sử dụng select 2" class="form-control" id="phone-customer" name="customer[phone]" value="">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="status-customer">
										{{ __('Trạng thái') }}
									</label>
									<input type="text" placeholder="Sử dụng select" class="form-control" id="status-customer" name="customer[status]" value="">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" name="customer[start_created_at]" value="">
										-
										<input type="date" placeholder="select" class="form-control" name="customer[end_created_at]" value="">
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
					<h4 class="card-title">{{ __('Khách Hàng') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Email') }}</th>
									<th>{{ __('Họ tên') }}</th>
									<th class="text-center">{{ __('Số điện thoại') }}</th>
									<th class="text-center">{{ __('Trạng thái') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								@if (count($customers) > 0)
									@foreach ($customers as $customer)
										<tr>
											<td class="text-center">{{ $page_customer }}</td>
											<td>
												{{ __($customer->email) }}
											</td>
											<td>
												{{ __($customer->name) }}
											</td>
											<td class="text-center">
												@if (!empty($customer->phone))
													{{ __($customer->phone) }}
												@else
													{{ __('Không có') }}
												@endif
											</td>
											<td class="text-center">
												{{ __($model_customer->status_model[$customer->status]) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y H:i', strtotime($customer->created_at)) }}
											</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Chi tiết" class="btn btn-info btn-simple btn-xs">
													<i class="fa fa-file"></i>
												</button>
												<button type="button" rel="tooltip" title="Chỉnh sửa" class="btn btn-success btn-simple btn-xs">
													<i class="fa fa-edit"></i>
												</button>
												<button type="button" rel="tooltip" title="Xóa" class="btn btn-danger btn-simple btn-xs">
													<i class="fa fa-times"></i>
												</button>
											</td>
										</tr>
										@php
											$page_customer++
										@endphp
									@endforeach
								@else
									<td class="text-center" colspan="7">
										<h4 class="my-3">
											{{ __('Chưa có thời gian') }}
										</h4>
									</td>
								@endif
							</tbody>
						</table>
					</div>

					<div class="text-right">
						{{ $customers->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection