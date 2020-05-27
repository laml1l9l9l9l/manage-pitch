@extends('Layout.Customer.NotUser.master')
@push('css')
	<title>
		{{ __('Đăng nhập') }}
	</title>
@endpush

@section('content')
	<div class="section">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="card card-signup">
					<form class="form" method="POST" action="{{ route('customer.process_login') }}">
						@csrf
						<div class="header header-primary text-center">
							<h4 class="card-title">
								{{ __('Đăng nhập') }}
							</h4>
						</div>
						<p class="description text-center">
							{{ __('Truy cập tài khoản cá nhân') }}
						</p>
						<div class="card-content">

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">email</i>
								</span>
								<input type="email" name="customer[email]" class="form-control"  id="email" placeholder="Email..." value="@if(!empty(old('customer')['email'])) {{ old('customer')['email'] }} @endif">
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

							<!-- If you want to add a checkbox to this form, uncomment this code

							<div class="checkbox">
								<label>
									<input type="checkbox" name="optionsCheckboxes" checked>
									Subscribe to newsletter
								</label>
							</div> -->
						</div>
						<div class="footer text-center">
							<button class="btn btn-primary btn-simple btn-wd btn-lg">
								{{ __('Xác nhận') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
@endsection