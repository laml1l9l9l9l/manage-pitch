@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm thời gian') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.time.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới thời gian') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Tên khoảng thời gian') }}
								</label>
								<input type="text" placeholder="Tên khoảng thời gian" class="form-control" id="name" name="pitch[name]" value="@if(!empty(old('pitch')['name'])) {{ old('pitch')['name'] }} @endif">
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
												Helpers::optionSelectArray($model_time->status_model, (!empty(old('time')['status'])) ? old('time')['status'] : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('status'))
		                					<label class="error text-danger">
		                						{{ $errors->first('status') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-6">
										<label for="period-time">
											{{ __('Thời gian') }}
										</label>
										<div class="form-inline custom-form-inline">
											<input type="time" placeholder="select" class="form-control" name="time[time_start]" value="">
											-
											<input type="time" placeholder="select" class="form-control" name="time[time_end]" value="">
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
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>
											{{ __('Khung giờ đặc biệt') }}
										</label>
										<br>
										<div class="radio radio-inline">
											<input type="radio" name="radio1" id="manually" value="option1" checked="checked">
											<label for="manually">
												{{ __('Bình thường') }}
											</label>
										</div>
										<div class="radio radio-inline">
											<input type="radio" name="radio1" id="increase-price" value="option1">
											<label for="increase-price">
												{{ __('Tăng giá') }}
											</label>
										</div>
		                				@if (!empty($errors) && $errors->has('type'))
		                					<label class="error text-danger">
		                						{{ $errors->first('type') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-6 d-none">
										<label for="time-increase-price">
											{{ __('Giá tăng') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="200,000" class="form-control text-right" data-type="currency" id="time-increase-price" name="pitch[price]" value="@if(!empty(old('pitch')['price'])) {{ old('pitch')['price'] }} @endif">
											<span class="input-group-addon">
												{{ __('VNĐ') }}
											</span>
										</div>
		                				@if (!empty($errors) && $errors->has('price'))
		                					<label class="error text-danger">
		                						{{ $errors->first('price') }}
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#increase-price, #manually').click(function () {
				if($('#increase-price').is(':checked'))
				{
					$('#time-increase-price').parent('div').parent('div').removeClass('d-none');
				}
				else
				{
					$('#time-increase-price').parent('div').parent('div').addClass('d-none');
				}
			})
		});
	</script>
@endpush