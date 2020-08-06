@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Quản trị viên') }}
	</title>
@endpush

@section('content')
    <div class="content">
		<div class="container-fluid">
			
			@include('Layout.Admin.Notification.message_basic')

			{{-- <div class="row">
				
				<div class="col-md-12 card">
					<div class="col-md-6 p-0">
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới') }}
							</h4>
						</div>
						<div class="card-content">
							<a href="{{ route('admin.role') }}" class="btn btn-primary btn-fill btn-wd">
								<i class="ti-lock"></i>
								{{ __('Thêm quyền quản trị') }}
							</a>
						</div>
					</div>
				</div>

			</div> --}}

			<div class="row">


				<div class="col-md-12 card">

					<div class="card-header">
						<h4 class="card-title">{{ __('Quản trị viên') }}</h4>
					</div>

					<div class="card-content">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-bold">
										<th class="text-center">#</th>
										<th>{{ __('Email') }}</th>
										<th>{{ __('Họ tên') }}</th>
										<th class="text-right">{{ __('Ngày tạo') }}</th>
										<th class="text-right">{{ __('Thao Tác') }}</th>
									</tr>
								</thead>
								<tbody>
									@if (count($admins) > 0)
										@foreach ($admins as $admin)
											<tr>
												<td class="text-center">{{ $page_admin }}</td>
												<td>
													{{ __($admin->email) }}
												</td>
												<td>
													{{ __($admin->name) }}
												</td>
												<td class="text-right">
													{{ date('d-m-Y H:i', strtotime($admin->created_at)) }}
												</td>
												<td class="td-actions text-right">
													<a href="{{ route('admin.admin.edit', ['id' => $admin->id]) }}" rel="tooltip" title="Chỉnh sửa" class="btn btn-success btn-simple btn-xs">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											@php
												$page_admin++
											@endphp
										@endforeach
									@else
										<tr>
											<td class="text-center" colspan="4">
												<h4 class="my-3">
													{{ __('Chưa có quản trị viên') }}
												</h4>
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>

						<div class="text-right">
							{{ $admins->links() }}
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
@endsection