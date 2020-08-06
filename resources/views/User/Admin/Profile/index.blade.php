@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thông tin cá nhân') }}
	</title>
@endpush

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ __('Chỉnh sửa thông tin') }}
                </h4>
            </div>
            <div class="card-content">
                @include('Layout.Admin.Notification.message_basic')
                <form method="post" action="{{ route('admin.profile.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label>
                                	{{ __('Tài khoản') }}
                                </label>
                                <input type="text" class="form-control border-input" disabled placeholder="Email" value="{{ $account->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="input_name">{{ __('Họ và tên') }}</label>
                                <input type="text" class="form-control border-input" id="input_name" placeholder="Họ tên" name="profile[name]" value="@if(!empty($account->name)) {{ $account->name }} @elseif(!empty(old('profile')['name'])) {{ old('profile')['name'] }} @endif">
                                @if (!empty($errors) && $errors->has('profile.name'))
                                    <label class="error text-danger" for="input_name">
                                        {{ $errors->first('profile.name') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($show_add_role)
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                    <label>{{ __('Thêm quyền') }}</label>
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
                                            @if (count($account->array_role_admin) > 0)
                                                @foreach ($account->array_role_admin as $key => $role_admin)
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
                    @endif
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-fill btn-wd">
                            {{ __('Cập nhật') }}
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection