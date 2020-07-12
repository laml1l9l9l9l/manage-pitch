@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Sân bóng') }}
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
									<label for="name-pitch">
										{{ __('Tên sân bóng') }}
									</label>
									<input type="text" placeholder="Tên sân bóng" class="form-control" id="name-pitch" name="pitch[name]" value="@if(!empty($request_pitch['name'])){{ $request_pitch['name'] }}@endif">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="price-start-pitch">
										{{ __('Giá sân') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="text" placeholder="Giá thấp nhất" class="form-control text-right" id="price-start-pitch" data-type="currency" name="pitch[price_start]" value="@if(!empty($request_pitch['price_start'])){{ $request_pitch['price_start'] }}@endif">
										-
										<input type="text" placeholder="Giá cao nhất" class="form-control text-right" id="price-end-pitch" data-type="currency" name="pitch[price_end]" value="@if(!empty($request_pitch['price_end'])){{ $request_pitch['price_end'] }}@endif">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" name="pitch[start_created_at]" value="@if(!empty($request_pitch['start_created_at'])){{ $request_pitch['start_created_at'] }}@endif">
										-
										<input type="date" placeholder="select" class="form-control" name="pitch[end_created_at]" value="@if(!empty($request_pitch['end_created_at'])){{ $request_pitch['end_created_at'] }}@endif">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="type-pitch">
										{{ __('Loại sân') }}
									</label>
									<select class="selectpicker" id="type-pitch" data-style="btn btn-block" title="Chọn loại sân" data-size="5" name="pitch[type]">
										@php
											Helpers::optionSelectArray($model_pitch->type_model, (isset($request_pitch['type']) && $request_pitch['type'] !== null) ? $request_pitch['type'] : '' );
										@endphp
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="type-pitch">
										{{ __('Trạng thái sân') }}
									</label>
									<select class="selectpicker" id="type-pitch" data-style="btn btn-block" title="Chọn trạng thái sân" data-size="5" name="pitch[status]">
										@php
											Helpers::optionSelectArray($model_pitch->status_model, (isset($request_pitch['status']) && $request_pitch['status'] !== null) ? $request_pitch['status'] : '' );
										@endphp
									</select>
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<a href="{{ route('admin.pitch') }}" class="btn btn-fill btn-wd">
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
						<a href="{{ route('admin.pitch.add') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-menu"></i>
							{{ __('Thêm sân bóng') }}
						</a>
					</div>
				</div>
			</div>
		</div>



		<div class="row">


			<div class="col-md-12 card">

				<div class="card-header">
					<h4 class="card-title">{{ __('Sân bóng') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Tên sân bóng') }}</th>
									<th>{{ __('Loại sân') }}</th>
									<th class="text-right">{{ __('Giá') }}</th>
									<th class="text-center">{{ __('Hình ảnh') }}</th>
									<th class="text-center">{{ __('Trạng thái') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									@if (count($pitch) > 0)
										@foreach ($pitch as $element_pitch)
											<tr>
												<td class="text-center">{{ $page_pitch }}</td>
												<td>
													{{ __($element_pitch->name) }}
												</td>
												<td>
													{{ __($model_pitch->type_model[$element_pitch->type]) }}
												</td>
												<td class="text-right">
													{{ number_format(__($element_pitch->price)) . ' VNĐ' }}
												</td>
												<td class="text-center">
													@php
														$path_image = str_replace('public', 'storage', $element_pitch->image);
													@endphp
													<img src="{{ asset($path_image) }}" class="image-list">
												</td>
												<td class="text-center">
													{{ __($model_pitch->status_model[$element_pitch->status]) }}
												</td>
												<td class="text-right">
													{{ date('d-m-Y', strtotime($element_pitch->created_at)) }}
												</td>
												<td class="td-actions text-right">
													<a href="{{ route('admin.pitch.edit', ['id' => $element_pitch->id]) }}" rel="tooltip" title="Chỉnh sửa" class="btn btn-success btn-simple btn-xs">
														<i class="fa fa-edit"></i>
													</a>
													<button type="button" rel="tooltip" title="Xóa" class="btn btn-danger btn-simple btn-xs btn-delete" data-toggle="modal" data-target="#confirmDelete" data-id-item="{{ __($element_pitch->id) }}">
														<i class="fa fa-times"></i>
													</button>
												</td>
											</tr>
											@php
												$page_pitch++
											@endphp
										@endforeach
									@else
										<td class="text-center" colspan="8">
											<h4 class="my-3">
												{{ __('Chưa có sân bóng') }}
											</h4>
										</td>
									@endif
								</tr>
							</tbody>
						</table>
					</div>

					<div class="text-right">
						{{ $pitch->appends($request)->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- Modal confirm delete -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header d-flex">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Xác nhận') }}</h5>
				<button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ __('Bạn có muốn xóa?') }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Đóng') }}</button>
				<a type="button" class="btn btn-danger" id="btn-delete-item">{{ __('Xóa') }}</a>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
	<script type="text/javascript">
		var urlDeleteItem = '{{ route('admin.pitch.delete', ['id' => 0]) }}';
	</script>
	<script src="{{ asset('admin/js/custom-js/modal-confirm.js') }}"></script>
@endpush