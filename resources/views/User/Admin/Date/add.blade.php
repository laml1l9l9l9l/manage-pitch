@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm ngày tháng') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.date.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới ngày tháng') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Lý do') }}
								</label>
								<input type="text" placeholder="Lý do" class="form-control" id="name" name="date[name]" value="@if(!empty(old('date')['name'])) {{ old('date')['name'] }} @endif">
                				@if (!empty($errors) && $errors->has('name'))
                					<label class="error text-danger" for="name">
                						{{ $errors->first('name') }}
                					</label>
                				@endif
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label>
											{{ __('Ngày bắt đầu') }}
										</label>
										<input type="date" placeholder="select" class="form-control" name="date[date_start]" value="@if(!empty(old('date')['date_start'])){{old('date')['date_start']}}@endif">
		                				@if (!empty($errors) && $errors->has('date_start'))
		                					<label class="error text-danger">
		                						{{ $errors->first('date_start') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-6">
										<label>
											{{ __('Ngày kết thúc') }}
										</label>
										<input type="date" placeholder="select" class="form-control" name="date[date_end]" value="@if(!empty(old('date')['date_end'])){{old('date')['date_end']}}@endif">
		                				@if (!empty($errors) && $errors->has('date_end'))
		                					<label class="error text-danger">
		                						{{ $errors->first('date_end') }}
		                					</label>
		                				@endif
									</div>
								</div>
							</div>
							{{-- <div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>
											{{ __('Khung giờ đặc biệt') }}
										</label>
										<br>
										<div class="radio radio-inline">
											<input type="radio" name="date[date_special]" id="manually" value="{{ MANUALLY }}" @if(!isset(old('date')['date_special']) || old('date')['date_special'] == MANUALLY) checked="checked" @endif>
											<label for="manually">
												{{ __('Bình thường') }}
											</label>
										</div>
										<div class="radio radio-inline">
											<input type="radio" name="date[date_special]" id="increase-price" value="{{ INCREASE_PRICE }}" @if(isset(old('date')['date_special']) && old('date')['date_special'] == INCREASE_PRICE) checked="checked" @endif>
											<label for="increase-price">
												{{ __('Tăng giá') }}
											</label>
										</div>
		                				@if (!empty($errors) && $errors->has('date_special'))
		                					<label class="error text-danger">
		                						{{ $errors->first('date_special') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-6 d-none">
										<label for="time-increase-price">
											{{ __('Giá tăng') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="200,000" class="form-control text-right" data-type="currency" id="time-increase-price" name="date[increase_price]" value="@if(!empty(old('date')['increase_price'])) {{ old('date')['increase_price'] }} @endif">
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
							</div> --}}
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