@extends('Layout.Customer.master')
@push('css')
	<title>
		{{ __('Đăng ký') }}
	</title>
@endpush

@section('content')
	<div class="login-page">

		<div class="page-header header-filter" style="background-image: url({{ asset('custom/img/bg-new-1.jpg') }}); background-size: cover; background-position: top center;">
			<div class="container">
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

									<form class="form" method="" action="">
										<div class="card-content">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">face</i>
												</span>
												<input type="text" class="form-control" placeholder="Họ và tên...">
											</div>

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
			</div>

    		@include('Layout.Customer.footer')
		</div>

	</div>
@endsection