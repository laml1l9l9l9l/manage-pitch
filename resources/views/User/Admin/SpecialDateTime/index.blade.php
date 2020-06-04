@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thời gian tăng giá') }}
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
									<label for="name-time">
										{{ __('Thời gian') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="time" placeholder="select" class="form-control" name="special_datetime[time_start]" value="@if(!empty($request_special_datetime['time_start'])){{ $request_special_datetime['time_start'] }}@endif">
										-
										<input type="time" placeholder="select" class="form-control" name="special_datetime[time_end]" value="@if(!empty($request_special_datetime['time_end'])){{ $request_special_datetime['time_end'] }}@endif">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="status-time">
										{{ __('Trạng thái') }}
									</label>
									<select class="selectpicker" id="status-customer" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="special_datetime[status]">
										@php
											Helpers::optionSelectArray($model_special_datetime->status_model, (isset($request_special_datetime['status']) && $request_special_datetime['status'] !== null) ? $request_special_datetime['status'] : '' );
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
										<input type="date" placeholder="select" class="form-control" name="special_datetime[start_created_at]" value="@if(!empty($request_special_datetime['start_created_at'])){{ $request_special_datetime['start_created_at'] }}@endif">
										-
										<input type="date" placeholder="select" class="form-control" name="special_datetime[end_created_at]" value="@if(!empty($request_special_datetime['end_created_at'])){{ $request_special_datetime['end_created_at'] }}@endif">
									</div>
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<a href="{{ route('admin.specialdatetime') }}" class="btn btn-fill btn-wd" id="btn-reset">
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
						<a href="{{ route('admin.specialdatetime.addtime') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-alarm-clock"></i>
							{{ __('Thêm khung giờ tăng giá') }}
						</a>
						<a href="{{ route('admin.specialdatetime.adddate') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-calendar"></i>
							{{ __('Thêm ngày tăng giá') }}
						</a>
						<a href="{{ route('admin.specialdatetime.adddatetime') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-check-box"></i>
							{{ __('Thêm ngày giờ tăng giá') }}
						</a>
					</div>
				</div>
			</div>
		</div>



		<div class="row">


			<div class="col-md-12 card">

				<div class="card-header">
					<h4 class="card-title">{{ __('Thời gian') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Khung giờ') }}</th>
									<th class="text-right">{{ __('Ngày') }}</th>
									<th class="text-right">{{ __('Giá tăng') }}</th>
									<th class="text-center">{{ __('Trạng thái') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								@if (count($special_datetime) > 0)
									@foreach ($special_datetime as $element)
										<tr>
											<td class="text-center">{{ $page_special_datetime }}</td>
											<td>
												@if (!empty($element->time_slot_name))
													{{ __($element->time_slot_name) }}
												@else
													{{ __('Không có') }}
												@endif
											</td>
											<td class="text-right">
												@if (!empty($element->date))
													{{ date('d-m-Y', strtotime($element->date)) }}
												@else
													{{ __('Không có') }}
												@endif
											</td>
											<td class="text-right">
												@if (!empty($element->increase_price))
													{{ number_format(__($element->increase_price)) . ' VNĐ' }}
												@else
													{{ __('Không có') }}
												@endif
											</td>
											<td class="text-center">
												{{ __($model_special_datetime->status_model[$element->status]) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y', strtotime($element->created_at)) }}
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
											$page_special_datetime++
										@endphp
									@endforeach
								@else
									<td class="text-center" colspan="8">
										<h4 class="my-3">
											{{ __('Chưa có thời gian') }}
										</h4>
									</td>
								@endif
							</tbody>
						</table>
					</div>

					<div class="text-right">
						{{ $special_datetime->appends($request)->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection