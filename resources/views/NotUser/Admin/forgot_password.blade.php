@extends('Layout.Admin.NotUser.master')

@push('css')
	<title>
		{{ __('Quên mật khẩu') }}
	</title>
@endpush

@section('menu')
    <li>
       <a href="{{ route('admin.register') }}">
            {{ __('Đăng ký') }}
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
            <h2 class="text-white">
                {{ __('Quên mật khẩu') }}
            </h2>
            <hr>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2 text-center">
        <p class="text-white">
            {{ __('Mật khẩu mới sẽ được gửi vào email') }}
        </p>
    </div>
    <form method="POST" action="{{ route('admin.process_register') }}">
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