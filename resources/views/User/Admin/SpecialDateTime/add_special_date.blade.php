@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm ngày đặc biệt') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.specialdatetime.storedate') }}">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới ngày đặc biệt') }}
							</h4>
						</div>
						<div class="card-content">
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
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label for="increase-price">
											{{ __('Giá tăng') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="200,000" class="form-control text-right" data-type="currency" id="increase-price" name="date[increase_price]" value="@if(!empty(old('date')['increase_price'])) {{ old('date')['increase_price'] }} @endif">
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