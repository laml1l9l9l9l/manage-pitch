@extends('Layout.Customer.master')
@push('css')
	<title>
		{{ __('Đăng nhập') }}
	</title>
@endpush

@section('content')
	<div class="login-page">

		<div class="page-header header-filter" style="background-image: url({{ asset('custom/img/bg-new-1.jpg') }}); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="section">
					<div class="row">
						<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
							<div class="card card-signup">
								<form class="form" method="POST" action="">
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
											<input type="text" class="form-control" placeholder="Email...">
										</div>

										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">lock_outline</i>
											</span>
											<input type="password" placeholder="Mật khẩu..." class="form-control" />
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
			</div>

    		@include('Layout.Customer.footer')
		</div>

	</div>
@endsection