@extends('Layout.Customer.User.master')
@push('css')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>
		{{ __('Đặt giải') }}
	</title>
@endpush

@section('content')
	<div class="blog-posts">
		
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg-rent-league.jpg') }});">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="title">
							{{ __('Đặt giải') }}
						</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="main main-raised">
			<div class="container">

				<div class="section">
					<div class="row" id="row-title-notice">
						<div class="col-md-8 col-md-offset-2 text-center">
                        	<h2 class="title">
								{{ __('Chọn thời gian đặt giải') }}
                        	</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning">
							@include('Layout.Customer.Notification.message_basic')
						</div>
					</div>


					<div class="row" id="booking-pitchs">

						@if(!$data_suggest)
							<div class="row text-center">
								<h3>
									{{ __('Không có gợi ý nào. Vui lòng thử lại') }}
								</h3>
								<div class="col-md-12">
									<a href="{{ route('customer.check.book.pitchs', '#row-title-notice') }}" class="btn btn-round">
										<i class="fa fa-undo"></i> {{ __('Quay lại') }}
									</a>
								</div>
							</div>
						@endif
						@foreach ($data_suggest as $data)
							@php
								if (!$data_suggest)
									break;
							@endphp
							<div class="col-md-12">
								<h3>
									{{ __(date('d-m-Y', strtotime($data->date))) }}
								</h3>
							</div>
							@php
								$informations = $data->informations;
							@endphp
							@foreach ($informations as $information)
								<div class="col-md-12">
									<div class="card">
										<div class="card-content">
											<div class="d-flex">
												<div class="col-md-1">
													<div class="checkbox">
														<label>
															<input type="checkbox" name="optionsCheckboxes" data-date="{{ __($data->date) }}" data-pitch="{{ __($information->pitch) }}" data-time="{{ __($information->time) }}" data-amount="{{ __($information->amount) }}">
														</label>
													</div>
												</div>
												<div class="col-md-3">
													<p>
														<b>{{ __('Ngày thuê') }}</b>
													</p>
													<p>
														{{ __(date('d-m-Y', strtotime($data->date))) }}
													</p>
												</div>
												<div class="col-md-2">
													<p>
														<b>{{ __('Khung giờ') }}</b>
													</p>
													<p>
														{{ __($information->time_name) }}
													</p>
												</div>
												<div class="col-md-3">
													<p>
														<b>{{ __('Sân bóng') }}</b>
													</p>
													<p>
														{{ __($information->pitch_name) }}
													</p>
												</div>
												<div class="col-md-3">
													<p>
														<b>{{ __('Giá') }}</b>
													</p>
													<p>
														{{ __(number_format($information->amount).' VNĐ') }}
													</p>
												</div>
											</div>							
										</div>
									</div>
								</div>
							@endforeach
						@endforeach

						@if($data_suggest)
							<div class="col-md-6 col-md-offset-3 text-center">
								<button class="btn btn-primary" id="confirm-suggest-bill">
									{{ __('Xác nhận') }}
								</button>
							</div>
						@endif

					</div>
				</div>

			</div>{{-- end container --}}

	    </div>{{-- end main --}}

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
									<input type="text" class="form-control" id="email_custom_login" placeholder="Email..." />
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" class="form-control" id="password_custom_login" placeholder="Mật khẩu..." />
								</div>

								<div class="col-md-12 d-flex justify-content-between pr-0">
									{{-- <a href="#" class="footer-form btn-forgot-password" data-toggle="modal" data-target="#modalForgotPassword">
										{{ __('Quên mật khẩu?') }}
									</a> --}}
									{{-- <a href="#" class="footer-form btn-register" data-toggle="modal" data-target="#modalRegister"> --}}
									<a href="{{ route('customer.register') }}" class="btn-register">
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
									{{-- <a href="#" class="footer-form btn-forgot-password" data-toggle="modal" data-target="#modalForgotPassword">
										{{ __('Quên mật khẩu?') }}
									</a> --}}
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
@endsection

@push('js')
	<script type="text/javascript">
		{{-- route --}}
		let routeAddVisualDetailBill    = '{{ route('customer.add.visual.detail.bill') }}';
		let routeRemoveVisualDetailBill = '{{ route('customer.remove.visual.detail.bill') }}';
		let urlGetInformation = '{{ route('customer.infor') }}';
		var urlLogin          = '{{ route('customer.login.ajax') }}';
		var urlConfirmBills   = '{{ route('customer.confirm.book.pitchs') }}';
	</script>
	<script src="{{ asset('custom/js/component/suggest-booking-pitchs.js') }}"></script>
@endpush