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
                                <input type="text" class="form-control border-input" id="input_name" placeholder="Họ tên" name="profile[name]" value="{{ $account->name }}">
                                @if (!empty($errors) && $errors->has('profile.name'))
                                    <label class="error text-danger" for="input_name">
                                        {{ $errors->first('profile.name') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label>{{ __('Quyền') }}</label>
                                <input type="text" class="form-control border-input" id="input_id_role" placeholder="Quyền" name="profile[id_role]">
                                @if (!empty($errors) && $errors->has('profile.id_role'))
                                    <label class="error text-danger" for="input_id_role">
                                        {{ $errors->first('profile.id_role') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
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