@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Chỉnh sửa quản trị viên') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.admin.update', ['id' => $admin->id]) }}" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Chỉnh sửa quản trị viên') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>
											{{ __('Email') }}
										</label>
										<input type="text" placeholder="Email" class="form-control" disable value="@if(!empty($admin->email)) {{ $admin->email }} @endif">
									</div>
									<div class="col-sm-6">
										<label for="name">
											{{ __('Họ tên') }}
										</label>
										<input type="text" placeholder="Họ tên" class="form-control" id="name" name="admin[name]" disable value="@if(!empty($admin->name)) {{ $admin->name }} @endif">
		                				@if (!empty($errors) && $errors->has('name'))
		                					<label class="error text-danger" for="name">
		                						{{ $errors->first('name') }}
		                					</label>
		                				@endif
		                			</div>
	                			</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>
											{{ __('Đổi mật khẩu') }}
										</label>
										<input type="password" class="form-control" name="admin[password]">
		                				@if (!empty($errors) && $errors->has('password'))
		                					<label class="error text-danger">
		                						{{ $errors->first('password') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-sm-6">
										<label>
											{{ __('Quyền quản trị') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn quyền" data-size="5" name="profile[id_role]">
		                                    @php
		                                        Helpers::optionSelectArray($model_roles->arrayRole(), (isset(old('profile')['id_role']) && old('profile')['id_role'] !== null) ? strval(old('profile')['id_role']) : '' );
		                                    @endphp
		                                </select>
		                                @if (!empty($errors) && $errors->has('profile.id_role'))
		                                    <label class="error text-danger" for="input_id_role">
		                                        {{ $errors->first('profile.id_role') }}
		                                    </label>
		                                @endif
		                                <label class="d-flex">
		                                    {{ __('Xóa quyền hiện tại:') }}
		                                    &nbsp;
		                                    <div class="text-danger d-flex">
		                                        @if (count($admin->array_role_admin) > 0)
		                                            @foreach ($admin->array_role_admin as $key => $role_admin)
		                                                <a href="{{ route('admin.role.remove', ['id' => $key]) }}">
		                                                    {{ $role_admin }}
		                                                </a>
		                                                &nbsp;
		                                            @endforeach
		                                        @else
		                                            {{ __('Chưa có quyền') }}
		                                        @endif
		                                    </div>
		                                </label>
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