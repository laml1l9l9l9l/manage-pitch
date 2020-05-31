@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm khung giờ đặc biệt') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.specialdatetime.storedate') }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới khung giờ đặc biệt') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label>
											{{ __('Khung giờ bắt đầu') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn khung giờ" data-size="5" name="time[time_slot_start]">
											@php
												Helpers::optionSelectArray($array_time_slot, (isset(old('time')['time_slot_start']) && old('time')['time_slot_start'] !== null) ? old('time')['time_slot_start'] : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('time_slot_start'))
		                					<label class="error text-danger">
		                						{{ $errors->first('time_slot_start') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-6">
										<label>
											{{ __('Khung giờ kết thúc') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn khung giờ" data-size="5" name="time[time_slot_end]">
											@php
												Helpers::optionSelectArray($array_time_slot, (isset(old('time')['time_slot_end']) && old('time')['time_slot_end'] !== null) ? old('time')['time_slot_end'] : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('time_slot_end'))
		                					<label class="error text-danger">
		                						{{ $errors->first('time_slot_end') }}
		                					</label>
		                				@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label for="increase-price">
											{{ __('Giá tăng') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="200,000" class="form-control text-right" data-type="currency" id="increase-price" name="time[increase_price]" value="@if(!empty(old('time')['increase_price'])) {{ old('time')['increase_price'] }} @endif">
											<span class="input-group-addon">
												{{ __('VNĐ') }}
											</span>
										</div>
		                				@if (!empty($errors) && $errors->has('increase_price'))
		                					<label class="error text-danger">
		                						{{ $errors->first('increase_price') }}
		                					</label>
		                				@endif
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-fill btn-info">
								{{ __('Thêm mới') }}
							</button>
						</div>
					</form>
				</div> <!-- end card -->
			</div>

		</div>
	</div>
</div>
@endsection

@push('js')
	<script src="{{ asset('admin/js/custom-js/form-add-item.js') }}"></script>
@endpush