@extends('Layout.Customer.User.master')
@push('css')
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
						<div class="col-md-7 col-md-offset-2 text-center">
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

						<div class="col-md-12">
							<div class="card">
								<div class="card-content">

									<form>
										@csrf
										<div class="my-2">
											<label>
												<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Chọn khoảng ngày thuê') }}</h4>
												<small id="selectDateHelp" class="form-text text-muted">
													{{ __('Hãy chọn ngày bắt đầu và kết thúc') }}
												</small>
											</label>
											<div class="row">
												<div class="d-flex justify-content-between">
													<div class="col-md-5 p-0">
														<input type="date" class="form-control" name="book[start_date]" />
													</div>
													<div class="col-md-5 p-0">
														<input type="date" class="form-control" name="book[end_date]" />
													</div>
												</div>
											</div>
										</div>
										<div class="my-2">
											<label>
												<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Chọn khoảng giờ thuê') }}</h4>
												<small id="selectDateHelp" class="form-text text-muted">
													{{ __('Hãy chọn giờ bắt đầu và kết thúc') }}
												</small>
											</label>
											<div class="row">
												<div class="d-flex justify-content-between">
													<div class="col-md-5 p-0">
														<input type="time" class="form-control" name="book[start_time]" />
													</div>
													<div class="col-md-5 p-0">
														<input type="time" class="form-control" name="book[end_time]" />
													</div>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-primary">
											{{ __('Xác nhận') }}
										</button>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>{{-- end container --}}

	    </div>{{-- end main --}}

    </div>
@endsection

@push('js')
@endpush