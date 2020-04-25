@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Menu') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-12 card">
				<div class="col-md-6 p-0">
					<div class="card-header">
						<h4 class="card-title">
							{{ __('Thêm mới') }}
						</h4>
					</div>
					<div class="card-content">
						<a href="{{ route('admin.menu.add') }}" class="btn btn-primary btn-fill btn-wd">
							<i class="ti-menu"></i>
							{{ __('Thêm menu') }}
						</a>
						<a href="{{ route('admin.group.menu.add') }}" class="btn btn-info btn-fill btn-wd">
							<i class="ti-menu-alt"></i>
							{{ __('Thêm nhóm menu') }}
						</a>
					</div>
				</div>
			</div>

		</div>

		<div class="row">


			<div class="col-md-8 card">

				<div class="card-header">
					<h4 class="card-title">Menu</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>{{ __('Tên menu') }}</th>
									<th>{{ __('Link') }}</th>
									<th>{{ __('Loại menu') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								@if (count($menu) > 0)
									@foreach ($menu as $element_menu)
										<tr>
											<td class="text-center">{{ $page }}</td>
											<td>
												{{ __($element_menu->name) }}
											</td>
											<td>
												{{ __($element_menu->link) }}
											</td>
											<td>
												{{ __($model_menu->status_model[$element_menu->level_menu]) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y', strtotime($element_menu->created_at)) }}
											</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
													<i class="fa fa-user"></i>
												</button>
												<button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
													<i class="fa fa-edit"></i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
													<i class="fa fa-times"></i>
												</button>
											</td>
										</tr>
										@php
											$page++
										@endphp
									@endforeach
								@else
									<tr>
										<td class="text-center" colspan="3">
											{{ __('Chưa có menu') }}
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="col-md-4 pr-0">
				<div class="card ml-2">
					<div class="card-header">
						<h4 class="card-title">Nhóm menu</h4>
					</div>

					<div class="card-content">
						
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>{{ __('Tên Nhóm') }}</th>
										<th class="text-right">{{ __('Thao Tác') }}</th>
									</tr>
								</thead>
								<tbody>
									@if (count($group_menu) > 0)
										@foreach ($group_menu as $element_group_menu)
											<tr>
												<td class="text-center">{{ $page }}</td>
												<td>
													{{ __($element_group_menu->name) }}
												</td>
												<td class="td-actions text-right">
													<button type="button" rel="tooltip" title="Chi Tiết" class="btn btn-info btn-simple btn-xs">
														<i class="fa fa-file"></i>
													</button>
													<button type="button" rel="tooltip" title="Chỉnh Sửa" class="btn btn-success btn-simple btn-xs">
														<i class="fa fa-edit"></i>
													</button>
													<button type="button" rel="tooltip" title="Xóa" class="btn btn-danger btn-simple btn-xs">
														<i class="fa fa-times"></i>
													</button>
												</td>
											</tr>
											@php
												$page++
											@endphp
										@endforeach
									@else
										<tr>
											<td class="text-center" colspan="3">
												{{ __('Chưa có nhóm menu') }}
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>

						<div class="text-right">
							{{ $group_menu->links() }}
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection