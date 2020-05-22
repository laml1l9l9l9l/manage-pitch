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
									<input type="text" placeholder="Tên sân bóng" class="form-control" name="pitch[name]" id="name-pitch">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="type-pitch">
										{{ __('Loại sân') }}
									</label>
									<input type="text" placeholder="Email" class="form-control" name="pitch[type]" id="type-pitch">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="price-pitch">
										{{ __('Giá') }}
									</label>
									<input type="text" placeholder="Giá sân" class="form-control" id="price-pitch" name="pitch[price]" value="">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" name="bill[start_created_at]" value="">
										-
										<input type="date" placeholder="select" class="form-control" name="bill[end_created_at]" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<button class="btn btn-fill btn-wd" id="btn-reset" type="reset">
									<i class="ti-reload"></i>
									{{ __('Làm mới') }}
								</button>
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
									<th class="text-center">{{ __('Giá') }}</th>
									<th class="text-center">{{ __('Hình ảnh') }}</th>
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
													{{ __($model_pitch->status_model[$element_pitch->type]) }}
												</td>
												<td class="text-right">
													{{ number_format(__($element_pitch->price)) . ' VNĐ' }}
												</td>
												<td class="text-center">
													@php
														$path_image = str_replace('public', 'storage', $element_pitch->image);
													@endphp
													<img src="{{ asset($path_image) }}" class="image-list">
													{{-- <img src="{{ asset($element_pitch->image) }}"> --}}
												</td>
												<td class="text-right">
													{{ date('d-m-Y', strtotime($element_pitch->created_at)) }}
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
										@endforeach
									@else
										<td class="text-center" colspan="7">
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
						{{-- Phân trang --}}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection