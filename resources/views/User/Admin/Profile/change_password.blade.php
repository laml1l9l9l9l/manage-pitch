@extends('Layout.Admin.User.master')

@push('css')
    <title>
        {{ __('Đổi mật khẩu') }}
    </title>
@endpush

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ __('Đổi mật khẩu') }}
                </h4>
            </div>
            <div class="card-content">
                @include('Layout.Admin.Notification.message_basic')
                <form method="post" action="{{ route('admin.update.password') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="input_password_old">
                                    {{ __('Mật khẩu hiện tại') }}
                                </label>
                                <input type="password" class="form-control border-input" id="input_password_old" placeholder="Mật khẩu cũ" name="profile[old_password]">
                                @if (!empty($errors) && $errors->has('old_password'))
                                    <label class="error text-danger" for="input_password_old">
                                        {{ $errors->first('old_password') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="input_password">{{ __('Mật khẩu mới') }}</label>
                                <input type="password" class="form-control border-input" id="input_password" placeholder="Mật khẩu mới" name="profile[password]">
                                @if (!empty($errors) && $errors->has('password'))
                                    <label class="error text-danger" for="input_password">
                                        {{ $errors->first('password') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="input_password_confirm">{{ __('Nhập lại mật khẩu') }}</label>
                                <input type="password" class="form-control border-input" id="input_password_confirm" placeholder="Nhập lại mật khẩu" name="profile[password_confirmation]">
                                @if (!empty($errors) && $errors->has('password_confirmation'))
                                    <label class="error text-danger" for="input_password_confirm">
                                        {{ $errors->first('password_confirmation') }}
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