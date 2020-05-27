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
                        	<h2 class="title">{{ __('Thuê sân bóng') }}</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning"></div>
					</div>

					{{-- Calendar --}}
					<div class="row" id="row-calendar">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn ngày thuê') }}</h3>
                        </div>
                        <div id="calendar"></div>
						<div class="tab-space"></div>
					</div>


					<div class="row d-none" id="row-pitch">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn sân thuê') }}</h3>
                        </div>
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
							</div>
						@endforeach

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
						<form class="d-none" method="POST" action="#" id="form-create-bill">
							@csrf
							<input type="hidden" class="d-none" id="date-rent" name="bill[date]">
							<input type="hidden" class="d-none" id="pitch-rent" name="bill[pitch]">
							<input type="hidden" class="d-none" id="time-slot-rent" name="bill[time_slot]">
						</form>
					</div>


					<div class="row">

						<div class="col-md-6">
							<div class="card card-raised card-background" style="background-image: url('../assets/img/examples/office2.jpg')">
								<div class="card-content">
									<h6 class="category text-info">Worlds</h6>
									<a href="#pablo">
										<h3 class="card-title">The Best Productivity Apps on Market</h3>
									</a>
									<p class="card-description">
										Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
									</p>
									<a href="#pablo" class="btn btn-danger btn-round">
										<i class="material-icons">format_align_left</i> Read Article
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card card-raised card-background" style="background-image: url('../assets/img/examples/blog8.jpg')">
								<div class="card-content">
									<h6 class="category text-info">Business</h6>
									<h3 class="card-title">Working on Wallstreet is Not So Easy</h3>
									<p class="card-description">
										Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
									</p>
									<a href="#pablo" class="btn btn-primary btn-round">
										<i class="material-icons">format_align_left</i> Read Article
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="card card-raised card-background" style="background-image: url('../assets/img/examples/card-project6.jpg')">
								<div class="card-content">
									<h6 class="category text-info">Marketing</h6>
									<h3 class="card-title">0 to 100.000 Customers in 6 months</h3>
									<p class="card-description">
										Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
									</p>
									<a href="#pablo" class="btn btn-warning btn-round">
										<i class="material-icons">subject</i> Read Case Study
									</a>
									<a href="#pablo" class="btn btn-white btn-just-icon btn-simple" title="Save to Pocket" rel="tooltip">
										<i class="fa fa-get-pocket"></i>
									</a>

								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="section">
					<h3 class="title text-center">You may also be interested in</h3>
					<br />
					<div class="row">
						<div class="col-md-4">
							<div class="card card-plain card-blog">
								<div class="card-image">
									<a href="#pablo">
										<img class="img img-raised" src="../assets/img/bg5.jpg" />
									</a>
								</div>

								<div class="card-content">
									<h6 class="category text-info">Enterprise</h6>
									<h4 class="card-title">
										<a href="#pablo">Autodesk looks to future of 3D printing with Project Escher</a>
									</h4>
									<p class="card-description">
										Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses.<a href="#pablo"> Read More </a>
									</p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-plain card-blog">
								<div class="card-image">
									<a href="#pablo">
										<img class="img img-raised" src="../assets/img/examples/blog5.jpg" />
									</a>
								</div>
								<div class="card-content">
									<h6 class="category text-success">
										Startups
									</h6>
									<h4 class="card-title">
										<a href="#pablo">Lyft launching cross-platform service this week</a>
									</h4>
									<p class="card-description">
										Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses.<a href="#pablo"> Read More </a>
									</p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-plain card-blog">
								<div class="card-image">
									<a href="#pablo">
										<img class="img img-raised" src="../assets/img/examples/blog6.jpg" />
									</a>
								</div>

								<div class="card-content">
									<h6 class="category text-danger">
										<i class="material-icons">trending_up</i> Enterprise
									</h6>
									<h4 class="card-title">
										<a href="#pablo">6 insights into the French Fashion landscape</a>
									</h4>
									<p class="card-description">
										Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses.<a href="#pablo"> Read More </a>
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="team-5 section-image" style="background-image: url('{{ asset('custom/img/bg10.jpg') }}')">

				<div class="container">
					<div class="row">

						<div class="col-md-6">
							<div class="card card-profile card-plain">
								<div class="col-md-5">
									<div class="card-image">
										<a href="#pablo">
											<img class="img" src="../assets/img/faces/card-profile1-square.jpg" />
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="card-content">
										<h4 class="card-title">Alec Thompson</h4>
										<h6 class="category text-muted">Author of the Month</h6>

										<p class="card-description">
											Don't be scared of the truth because we need to restart the human foundation in truth...
										</p>

										<div class="footer">
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-twitter"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-facebook-square"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-google"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card card-profile card-plain">
								<div class="col-md-5">
									<div class="card-image">
										<a href="#pablo">
											<img class="img" src="../assets/img/faces/card-profile4-square.jpg" />
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="card-content">
										<h4 class="card-title">Kendall Andrew</h4>
										<h6 class="category text-muted">Author of the Week</h6>

										<p class="card-description">
											Don't be scared of the truth because we need to restart the human foundation in truth...
										</p>

										<div class="footer">
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-linkedin"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-facebook-square"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-dribbble"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-google"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>

			<div class="subscribe-line">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h3 class="title">Get Tips & Tricks every Week!</h4>
							<p class="description">
								Join our newsletter and get news in your inbox every week! We hate spam too, so no worries about this.
							</p>
						</div>
						<div class="col-md-6">
							<div class="card card-plain card-form-horizontal">
								<div class="card-content">
									<form method="" action="">
										<div class="row">
											<div class="col-md-8">

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">mail</i>
													</span>
													<input type="email" value="" placeholder="Your Email..." class="form-control" />
												</div>
											</div>
											<div class="col-md-4">
												<button type="button" class="btn btn-primary btn-round btn-block">Subscribe</button>
											</div>
										</div>
									</form>
								</div>
							</div>

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
									<input type="text" name="custom[email]" class="form-control" placeholder="Email...">
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" name="custom[password]" class="form-control" placeholder="Mật khẩu..."/>
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
					<button type="button" class="btn btn-info">
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
    <script src="{{ asset('custom/js/component/home.js') }}"></script>
    <script src="{{ asset('custom/js/component/form-home.js') }}"></script>

@endpush