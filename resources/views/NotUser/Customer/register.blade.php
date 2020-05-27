@extends('Layout.Customer.NotUser.master')
@push('css')
	<title>
		{{ __('Đăng ký') }}
	</title>
@endpush

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<div class="card card-signup">
                <h2 class="card-title text-center">
					{{ __('Đăng ký') }}
                </h2>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="social text-center">
                            <h4> Vui lòng điền đầy đủ thông tin </h4>
                        </div>

						<form class="form" method="POST" action="{{ route('customer.process_register') }}">
							@csrf
							<div class="card-content">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">face</i>
									</span>
									<input type="text" name="customer[name]" class="form-control" id="name" placeholder="Họ và tên..." value="@if(!empty(old('customer')['name'])) {{ old('customer')['name'] }} @endif">
			                        @if (!empty($errors) && $errors->has('name'))
			                            <label class="error text-danger" for="name">
			                                {{ $errors->first('name') }}
			                            </label>
			                        @endif
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">email</i>
									</span>
									<input type="email" name="customer[email]" class="form-control" id="email" placeholder="Email..."  value="@if(!empty(old('customer')['email'])) {{ old('customer')['email'] }} @endif">
			                        @if (!empty($errors) && $errors->has('email'))
			                            <label class="error text-danger" for="email">
			                                {{ $errors->first('email') }}
			                            </label>
			                        @endif
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" name="customer[password]" class="form-control" id="password" placeholder="Mật khẩu..."/>
			                        @if (!empty($errors) && $errors->has('password'))
			                            <label class="error text-danger" for="password">
			                                {{ $errors->first('password') }}
			                            </label>
			                        @endif
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" class="form-control" id="password-confirmation" placeholder="Nhập lại mật khẩu..." name="customer[password_confirmation]"/>
			                        @if (!empty($errors) && $errors->has('password_confirmation'))
			                            <label class="error text-danger" for="password-confirmation">
			                                {{ $errors->first('password_confirmation') }}
			                            </label>
			                        @endif
								</div>
							</div>
							<div class="footer text-center">
								<button class="btn btn-primary btn-round">
									{{ __('Xác nhận') }}
								</button>
							</div>
						</form>
                    </div>
                </div>
        	</div>

        </div>

	</div>
@endsection