@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Menu') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
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
									<th>Name</th>
									<th>Job Position</th>
									<th>Since</th>
									<th class="text-right">Salary</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">1</td>
									<td>Andrew Mike</td>
									<td>Develop</td>
									<td>2013</td>
									<td class="text-right">&euro; 99,225</td>
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
								<tr>

									<td class="text-center">2</td>
									<td>John Doe</td>
									<td>Design</td>
									<td>2012</td>
									<td class="text-right">&euro; 89,241</td>
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
								<tr>
									<td class="text-center">3</td>
									<td>Alex Mike</td>
									<td>Design</td>
									<td>2010</td>
									<td class="text-right">&euro; 92,144</td>
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
								<tr>
									<td class="text-center">4</td>
									<td>Mike Monday</td>
									<td>Marketing</td>
									<td>2013</td>
									<td class="text-right">&euro; 49,990</td>
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
								<tr>
									<td class="text-center">5</td>
									<td>Paul Dickens</td>
									<td>Communication</td>
									<td>2014</td>
									<td class="text-right">&euro; 69,201</td>
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
										<th>Name</th>
										<th class="text-right">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($group_menu as $element_group_menu)
										<tr>
											<td class="text-center">1</td>
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
									@endforeach
								</tbody>
							</table>
						</div>

						{{ $group_menu->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection