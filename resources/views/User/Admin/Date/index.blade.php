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
									<input type="text" placeholder="Tên sự kiện" class="form-control" id="name-date" name="date[name]" value="@if(!empty($request_date['name'])){{ $request_date['name'] }}@endif">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày nghỉ') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" class="form-control" name="date[start_date]" value="@if(!empty($request_date['start_date'])){{ $request_date['start_date'] }}@endif">
										-
										<input type="date" class="form-control" name="date[end_date]" value="@if(!empty($request_date['end_date'])){{ $request_date['end_date'] }}@endif">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" class="form-control" name="date[start_created_at]" value="@if(!empty($request_date['start_created_at'])){{ $request_date['start_created_at'] }}@endif">
										-
										<input type="date" class="form-control" name="date[end_created_at]" value="@if(!empty($request_date['end_created_at'])){{ $request_date['end_created_at'] }}@endif">
									</div>
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<a href="{{ route('admin.date') }}" class="btn btn-fill btn-wd" id="btn-reset">
									<i class="ti-reload"></i>
									{{ __('Làm mới') }}
								</a>
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
						<a href="{{ route('admin.date.add') }}" class="btn btn-primary btn-fill btn-wd">
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
									<th class="text-right">{{ __('Ngày') }}</th>
									<th class="text-center">{{ __('Trạng thái') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								@if (count($dates) > 0)
									@foreach ($dates as $date)
										<tr>
											<td class="text-center">{{ $page_date }}</td>
											<td>
												{{ __($date->name) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y', strtotime($date->date)) }}
											</td>
											<td class="text-center">
												{{ __($model_date->status_model[$date->status]) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y H:i', strtotime($date->created_at)) }}
											</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Chỉnh sửa" class="btn btn-success btn-simple btn-xs">
													<i class="fa fa-edit"></i>
												</button>
												<button type="button" rel="tooltip" title="Xóa" class="btn btn-danger btn-simple btn-xs">
													<i class="fa fa-times"></i>
												</button>
											</td>
										</tr>
										@php
											$page_date++
										@endphp
									@endforeach
								@else
									<td class="text-center" colspan="6">
										<h4 class="my-3">
											{{ __('Chưa có thời gian') }}
										</h4>
									</td>
								@endif
							</tbody>
						</table>
					</div>

					<div class="text-right">
						{{ $dates->appends($request)->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection