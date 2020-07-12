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
					<form method="post" action="{{ route('admin.date.update', ['id' => $date->id]) }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Chỉnh sửa ngày nghỉ') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Sự kiện') }}
								</label>
								<input type="text" placeholder="Sự kiện" class="form-control" id="name" name="date[name]" value="@if(!empty($date->name)) {{ $date->name }} @endif">
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
											{{ __('Ngày') }}
										</label>
										<input type="date" class="form-control" name="date[date]" value="@if(!empty($date->date)){{ $date->date }}@endif">
		                				@if (!empty($errors) && $errors->has('date'))
		                					<label class="error text-danger">
		                						{{ $errors->first('date') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-sm-6">
										<label>
											{{ __('Trạng thái') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="date[status]">
											@php
												Helpers::optionSelectArray($model_date->status_model, (isset($date->status) && $date->status !== null) ? strval($date->status) : '' );
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