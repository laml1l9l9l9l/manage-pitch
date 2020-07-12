@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Phân quyền') }}
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
								<i class="ti-key"></i>
								{{ __('Thêm Permission') }}
							</a>
						</div>
					</div>
				</div>

			</div>

			<div class="row">


				<div class="col-md-12 card">

					<div class="card-header">
						<h4 class="card-title">{{ __('Phân quyền') }}</h4>
					</div>

					<div class="card-content">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-bold">
										<th class="text-center">#</th>
										<th>{{ __('Tên permission') }}</th>
										<th class="text-right">{{ __('Ngày tạo') }}</th>
										<th class="text-right">{{ __('Thao Tác') }}</th>
									</tr>
								</thead>
								<tbody>
									@if (count($roles) > 0)
										@foreach ($roles as $role)
											<tr>
												<td class="text-center">{{ $page_role }}</td>
												<td>
													{{ __($role->name) }}
												</td>
												<td class="text-right">
													{{ date('d-m-Y H:i', strtotime($role->created_at)) }}
												</td>
												<td class="td-actions text-right">
													<button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
														<i class="fa fa-file"></i>
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
												$page_role++
											@endphp
										@endforeach
									@else
										<tr>
											<td class="text-center" colspan="4">
												<h4 class="my-3">
													{{ __('Chưa có quyền quản trị') }}
												</h4>
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>

						<div class="text-right">
							{{ $roles->links() }}
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
@endsection