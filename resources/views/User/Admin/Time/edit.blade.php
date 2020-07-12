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
					<form method="post" action="{{ route('admin.time.update', ['id' => $time_slot->id]) }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Chỉnh sửa ngày nghỉ') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Tên khoảng thời gian') }}
								</label>
								<input type="text" placeholder="Tên khoảng thời gian" class="form-control" id="name" name="time[name]" value="@if(!empty($time_slot->name)) {{ $time_slot->name }} @endif">
                				@if (!empty($errors) && $errors->has('name'))
                					<label class="error text-danger" for="name">
                						{{ $errors->first('name') }}
                					</label>
                				@endif
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>
											{{ __('Trạng thái') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="time[status]">
											@php
												Helpers::optionSelectArray($model_time->status_model, (isset($time_slot->status) && $time_slot->status !== null) ? strval($time_slot->status) : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('status'))
		                					<label class="error text-danger">
		                						{{ $errors->first('status') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-sm-6">
										<label>
											{{ __('Thời gian') }}
										</label>
										<div class="form-inline custom-form-inline">
											<input type="time" placeholder="select" class="form-control" name="time[time_start]" value="@if(!empty($time_slot->time_start)){{date('H:i', strtotime($time_slot->time_start))}}@endif">
											-
											<input type="time" placeholder="select" class="form-control" name="time[time_end]" value="@if(!empty($time_slot->time_end)){{date('H:i', strtotime($time_slot->time_end))}}@endif">
										</div>
		                				@if (!empty($errors) && $errors->has('time_start'))
		                					<label class="error text-danger">
		                						{{ $errors->first('time_start') }}
		                					</label>
		                				@elseif(!empty($errors) && $errors->has('time_end'))
		                					<label class="error text-danger">
		                						{{ $errors->first('time_end') }}
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