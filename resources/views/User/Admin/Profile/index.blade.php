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
                <form method="post">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label>
                                	{{ __('Tài khoản') }}
                                </label>
                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="Creative Code Inc.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="input_email">{{ __('Họ và tên') }}</label>
                                <input type="text" class="form-control border-input" id="input_email" placeholder="Họ tên" value="Chet" name="admin['name']">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="input_email">{{ __('Địa chỉ email') }}</label>
                                <input type="email" class="form-control border-input" id="input_email" placeholder="Email" name="admin['email']">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label>{{ __('Quyền') }}</label>
                                <input type="email" class="form-control border-input" placeholder="Quyền" name="admin['id_role']">
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