@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm sân bóng') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.pitch.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới sân bóng') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Tên sân bóng') }}
								</label>
								<input type="text" placeholder="Tên sân bóng" class="form-control" id="name" name="pitch[name]" value="@if(!empty(old('pitch')['name'])) {{ old('pitch')['name'] }} @endif">
                				@if (!empty($errors) && $errors->has('name'))
                					<label class="error text-danger" for="name">
                						{{ $errors->first('name') }}
                					</label>
                				@endif
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="link">
											{{ __('Loại sân') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn loại sân" data-size="5" name="pitch[type]">
											@php
												Helpers::optionSelectArray($model_pitch->status_model, (!empty(old('pitch')['type'])) ? old('pitch')['type'] : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('type'))
		                					<label class="error text-danger">
		                						{{ $errors->first('type') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-6">
										<label for="pitch-price">
											{{ __('Giá thuê') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="200,000" class="form-control text-right" data-type="currency" id="pitch-price" name="pitch[price]" value="@if(!empty(old('pitch')['price'])) {{ old('pitch')['price'] }} @endif">
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
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label>
											{{ __('Ảnh sân') }}
										</label>
										<input type="file" class="form-control-file" id="pitch-img" name="pitch[image]">
		                				@if (!empty($errors) && $errors->has('image'))
		                					<label class="error text-danger">
		                						{{ $errors->first('image') }}
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