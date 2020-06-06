@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Khung giờ') }}
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
									<label>
										{{ __('Thời gian') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="time" placeholder="select" class="form-control" name="time_slots[time_start]" value="@if(!empty($request_time_slots['time_start'])){{ $request_time_slots['time_start'] }}@endif">
										-
										<input type="time" placeholder="select" class="form-control" name="time_slots[time_end]" value="@if(!empty($request_time_slots['time_end'])){{ $request_time_slots['time_end'] }}@endif">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="status-time">
										{{ __('Trạng thái') }}
									</label>
									<select class="selectpicker" id="status-time" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="time_slots[status]">
										@php
											Helpers::optionSelectArray($model_time->status_model, (isset($request_time_slots['status']) && $request_time_slots['status'] !== null) ? $request_time_slots['status'] : '' );
										@endphp
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" name="time_slots[start_created_at]" value="@if(!empty($request_time_slots['start_created_at'])){{ $request_time_slots['start_created_at'] }}@endif">
										-
										<input type="date" placeholder="select" class="form-control" name="time_slots[end_created_at]" value="@if(!empty($request_time_slots['end_created_at'])){{ $request_time_slots['end_created_at'] }}@endif">
									</div>
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<a href="{{ route('admin.time') }}" class="btn btn-fill btn-wd" id="btn-reset">
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
						<a href="{{ route('admin.time.add') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-menu"></i>
							{{ __('Thêm khung giờ') }}
						</a>
					</div>
				</div>
			</div>
		</div>



		<div class="row">


			<div class="col-md-12 card">

				<div class="card-header">
					<h4 class="card-title">{{ __('Khung giờ') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Thời gian') }}</th>
									<th class="text-right">{{ __('Giờ bắt đầu') }}</th>
									<th class="text-right">{{ __('Giờ kết thúc') }}</th>
									<th class="text-center">{{ __('Trạng thái') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								@if (count($time_slots) > 0)
									@foreach ($time_slots as $time_slot)
										<tr>
											<td class="text-center">{{ $page_time }}</td>
											<td>
												{{ __($time_slot->name) }}
											</td>
											<td class="text-right">
												{{ date('H:i', strtotime($time_slot->time_start)) }}
											</td>
											<td class="text-right">
												{{ date('H:i', strtotime($time_slot->time_end)) }}
											</td>
											<td class="text-center">
												{{ __($model_time->status_model[$time_slot->status]) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y', strtotime($time_slot->created_at)) }}
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
											$page_time++
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
						{{ $time_slots->appends($request)->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection