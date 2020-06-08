@extends('Layout.Customer.User.master')
@push('css')
	<title>
		{{ __('Trang chủ') }}
	</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/fullcalendar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/custom-fullcalendar.css') }}">
@endpush

@section('content')
	<div class="blog-posts">
		
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg-football-ground.jpg') }});">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="title">
							{{ __('Rèn luyện thể thao, đẩy lùi dịch bệnh') }}
						</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="main main-raised">
			<div class="container">

				<div class="section">
					<div class="row" id="row-title-notice">
						<div class="col-md-6 col-md-offset-3 text-center">
                        	<h2 class="title">{{ __('Đặt sân bóng') }}</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning"></div>
						@include('Layout.Customer.Notification.message_basic')
					</div>

					{{-- Calendar --}}
					<div class="row" id="row-calendar">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Đặt ngày') }}</h3>
                        </div>
                        <div id="calendar"></div>
						<div class="tab-space"></div>
					</div>


					<div class="row d-none" id="row-pitch">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn sân') }}</h3>
                        </div>
                        @if (count($pitchs) > 0)
							@foreach ($pitchs as $pitch)
								<div class="col-md-6 text-center">
									@php
										$path_image = str_replace('public', 'storage', $pitch->image);
									@endphp
									<div class="img-container">
										<img src="{{ asset($path_image) }}" class="img-raised rounded img-custom img-pitch" data-pitch="{{ $pitch->id }}">
									</div>
									<h3>
										{{ __($pitch->name) }}
									</h3>
									<i>
										{{ __('Giá từ '.number_format($pitch->price).' VNĐ') }}
									</i>
								</div>
							@endforeach
						@else
							<div class="col-md-12 text-center">
								<h3>
									{{ __('Chưa có sân bóng') }}
								</h3>
							</div>
                        @endif

						<div class="col-md-12 text-center">
							<button class="btn btn-round" id="return-select-date">
								<i class="fa fa-undo"></i> {{ __('Quay lại') }}
							</button>
						</div>
					</div>

					<div class="row row-container d-none" id="row-time">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn khung giờ thuê') }}</h3>
                        </div>
						<div class="col-md-offset-3 col-md-6 text-center">
							<select class="selectpicker" id="select-time" data-style="btn btn-primary btn-round" title="{{ __('Chọn thời gian thuê') }}" data-size="7">
								@php
									Helpers::optionSelectBasic($time_slots, '');
								@endphp
							</select>
						</div>

						<div class="col-md-12 text-center">
							<button class="btn btn-round" id="return-select-pitch">
								<i class="fa fa-undo"></i> {{ __('Quay lại') }}
							</button>
						</div>
					</div>

					
					<div class="d-none">
						<form class="d-none" id="form-create-bill">
							@csrf
							<input type="hidden" class="d-none" id="date-rent" name="bill[date]">
							<input type="hidden" class="d-none" id="pitch-rent" name="bill[pitch]">
							<input type="hidden" class="d-none" id="time-slot-rent" name="bill[time_slot]">
							<input type="hidden" class="d-none" id="type-rent" name="type_rent">
						</form>
					</div>


					{{-- Rent league --}}
					<div class="row">

						<div class="col-md-12">
							<div class="card card-raised card-background" style="background-image: url('{{ asset('custom/img/bg-rent-league.jpg') }}')">
								<div class="card-content">
									<h3 class="card-title">{{ __('Đặt giải đấu') }}</h3>
									<p class="card-description">
										Hỗ trợ các cá nhân, tổ chức, tập thể đặt giải đấu nhanh chóng, dễ dàng
									</p>
									<a href="#pablo" class="btn btn-warning btn-round">
										<i class="material-icons">subject</i> {{ __('Đặt giải') }}
									</a>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="subscribe-line">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h3 class="title">Liên hệ</h4>
							<p class="description">
								Số điện thoại: 0983443679
								<br>
								Email: contact@gmail.com
							</p>
						</div>
					</div>
				</div>
			</div>
	    </div>

    </div>


	<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="material-icons">clear</i>
					</button>
					<h4 class="modal-title">
						{{ __('Đăng nhập') }}
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<form id="form-login">
							<div class="col-md-8 col-md-offset-2">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">email</i>
									</span>
									<input type="text" class="form-control" id="email_custom_login" placeholder="Email..." >
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" class="form-control" id="password_custom_login" placeholder="Mật khẩu..."/>
								</div>

								<div class="col-md-12 d-flex justify-content-between pr-0">
									<a href="#" class="footer-form btn-forgot-password" data-toggle="modal" data-target="#modalForgotPassword">
										{{ __('Quên mật khẩu?') }}
									</a>
									<a href="#" class="footer-form btn-register" data-toggle="modal" data-target="#modalRegister">
										{{ __('Đăng ký') }}
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="btn-login">
						{{ __('Đăng nhập') }}
					</button>
					<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">
						{{ __('Đóng') }}
					</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="material-icons">clear</i>
					</button>
					<h4 class="modal-title">
						{{ __('Đăng ký') }}
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<form id="form-register">
							<div class="col-md-8 col-md-offset-2">
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

								<div class="col-md-12 d-flex justify-content-between pr-0">
									<a href="#" class="footer-form btn-forgot-password" data-toggle="modal" data-target="#modalForgotPassword">
										{{ __('Quên mật khẩu?') }}
									</a>
									<a href="#" class="footer-form btn-login" data-toggle="modal" data-target="#modalLogin">
										{{ __('Đăng nhập') }}
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info">
						{{ __('Đăng ký') }}
					</button>
					<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">
						{{ __('Đóng') }}
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalForgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="material-icons">clear</i>
					</button>
					<h4 class="modal-title">
						{{ __('Quên mật khẩu') }}
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<form id="form-forgot-password">
							<div class="col-md-8 col-md-offset-2">
								<p class="text-center">
									{{ __('Mật khẩu mới sẽ được gửi vào email của bạn') }}
								</p>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">email</i>
									</span>
									<input type="text" name="custom[email]" class="form-control" placeholder="Email...">
								</div>

								<div class="col-md-12 d-flex justify-content-between pr-0">
									<a href="#" class="footer-form btn-login" data-toggle="modal" data-target="#modalLogin">
										{{ __('Đăng nhập') }}
									</a>
									<a href="#" class="footer-form btn-register" data-toggle="modal" data-target="#modalRegister">
										{{ __('Đăng ký') }}
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info">
						{{ __('Gửi') }}
					</button>
					<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">
						{{ __('Đóng') }}
					</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
    <script src="{{ asset('custom/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('custom/js/component/calendar.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
	{{-- Process rent football field --}}
	<script type="text/javascript">
		var urlGetInformation = '{{ route('customer.infor') }}';
		var urlCreateBill     = '{{ route('customer.bill.create') }}';
		var typeRent          = '{{ SIMPLE }}';
		var urlLogin          = '{{ route('customer.login.ajax') }}';
		var _token            = '{{ csrf_token() }}';
	</script>
    <script src="{{ asset('custom/js/component/home.js') }}"></script>
    <script src="{{ asset('custom/js/component/form-home.js') }}"></script>

@endpush