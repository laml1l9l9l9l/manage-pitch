@extends('Layout.Admin.NotUser.master')

@push('css')
	<title>
		{{ __('Đăng nhập') }}
	</title>
@endpush

@section('menu')
	<li>
       <a href="{{ route('admin.forgot.password') }}">
            {{ __('Quên mật khẩu') }}
        </a>
    </li>
    <li>
       <a href="{{ route('admin.register') }}">
            {{ __('Đăng ký') }}
        </a>
    </li>
@endsection

@section('content')
	<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form method="#" action="#">
            <div class="card" data-background="color" data-color="blue">
                <div class="card-header">
                    <h3 class="card-title">
						{{ __('Đăng nhập') }}
                    </h3>
                </div>
                <div class="card-content">
                    <div class="form-group">
                        <label>{{ __('Tài khoản') }}</label>
                        <input type="email" placeholder="Enter email" class="form-control input-no-border">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Mật khẩu') }}</label>
                        <input type="password" placeholder="Password" class="form-control input-no-border">
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-fill btn-wd ">
						{{ __('Xác nhận') }}
                    </button>
                    <div class="forgot">
                        <a href="#pablo">
							{{ __('Quên mật khẩu?') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection