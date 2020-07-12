@extends('Layout.Admin.NotUser.master')

@push('css')
	<title>
		{{ __('Đăng ký') }}
	</title>
@endpush

@section('menu')
    <li>
       <a href="{{ route('admin.forgot.password') }}">
            {{ __('Quên mật khẩu') }}
        </a>
    </li>
    <li>
       <a href="{{ route('admin.login') }}">
            {{ __('Đăng nhập') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="header-text">
            <h2 class="text-info">
                {{ __('Đăng ký') }}
            </h2>
            <hr>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.process.register') }}">
        @csrf
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-6 col-md-offset-3">
                <div class="card card-plain">
                    <div class="content">
                        <div class="form-group">
                            <label class="text-default">
                                {{ __('Email') }}
                            </label>
                            <input type="text" placeholder="Email" class="form-control" required="required" name="admin[email]" value="@if(!empty(old('admin')['email'])) {{ old('admin')['email'] }} @endif">
                            @if ( !empty($errors) && $errors->has('email') )
                                <small class="mb-2" role="alert">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-default">
                                {{ __('Mật khẩu') }}
                            </label>
                            <input type="password" placeholder="Mật khẩu" class="form-control" required="required" name="admin[password]">
                            @if (!empty($errors) && $errors->has('password'))
                                <small class="mb-2" role="alert">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-default">
                                {{ __('Nhập lại mật khẩu') }}
                            </label>
                            <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" required="required" name="admin[password_confirmation]">
                            @if (!empty($errors) && $errors->has('password_confirmation'))
                                <small class="mb-2" role="alert">
                                    <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="footer text-center">
                <button type="submit" class="btn btn-fill btn-danger btn-wd">
                    {{ __('Xác nhận') }}
                </button>
            </div>
        </div>
    </form>
@endsection