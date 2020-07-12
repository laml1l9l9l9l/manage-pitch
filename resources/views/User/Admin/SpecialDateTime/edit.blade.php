@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Chỉnh sửa ngày nghỉ') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.specialdatetime.update', ['id' => $special_datetime->id]) }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" class="form-control d-none" name="special_datetime[type_special_datetime]" value="{{ __($type_special_datetime) }}">
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Chỉnh sửa ngày nghỉ') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<div class="row">
									@if (!empty($special_datetime->date))
										<div class="col-sm-6">
											<label>
												{{ __('Ngày') }}
											</label>
											<input type="date" class="form-control" name="special_datetime[date]" value="@if(!empty($special_datetime->date)){{ $special_datetime->date }}@endif">
			                				@if (!empty($errors) && $errors->has('date'))
			                					<label class="error text-danger">
			                						{{ $errors->first('date') }}
			                					</label>
			                				@endif
										</div>
									@endif
									@if (!empty($special_datetime->id_time_slot))
										<div class="col-sm-6">
											<label>
												{{ __('Khung giờ') }}
											</label>
											<select class="selectpicker" data-style="btn btn-block" title="Chọn khung giờ" data-size="5" name="special_datetime[time_slot]">
												@php
													Helpers::optionSelectArray($array_time_slot, !empty($special_datetime->id_time_slot) ? strval($special_datetime->id_time_slot) : '' );
												@endphp
											</select>
			                				@if (!empty($errors) && $errors->has('time_slot'))
			                					<label class="error text-danger">
			                						{{ $errors->first('time_slot') }}
			                					</label>
			                				@endif
										</div>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="increase_price">
											{{ __('Giá tăng') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="Giá tăng" class="form-control text-right" id="increase_price" data-type="currency" name="special_datetime[increase_price]" value="@if(!empty($special_datetime->increase_price)) {{ number_format($special_datetime->increase_price) }} @endif">
											<span class="input-group-addon">
												{{ __('VNĐ') }}
											</span>
										</div>
		                				@if (!empty($errors) && $errors->has('increase_price'))
		                					<label class="error text-danger" for="increase_price">
		                						{{ $errors->first('increase_price') }}
		                					</label>
		                				@endif
		                			</div>
									<div class="col-sm-6">
										<label>
											{{ __('Trạng thái') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="special_datetime[status]">
											@php
												Helpers::optionSelectArray($model_special_datetime->status_model, (isset($special_datetime->status) && $special_datetime->status !== null) ? strval($special_datetime->status) : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('status'))
		                					<label class="error text-danger">
		                						{{ $errors->first('status') }}
		                					</label>
		                				@endif
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-fill btn-info">
								{{ __('Chỉnh sửa') }}
							</button>
						</div>
					</form>
				</div> <!-- end card -->
			</div>

		</div>
	</div>
</div>
@endsection