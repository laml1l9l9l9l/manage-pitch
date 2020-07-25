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
															<input type="checkbox" name="optionsCheckboxes">
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

						<div class="col-md-6 col-md-offset-3 text-center">
							<button class="btn btn-primary">
								{{ __('Xác nhận') }}
							</button>
						</div>

					</div>
				</div>

			</div>{{-- end container --}}

	    </div>{{-- end main --}}

    </div>
@endsection

@push('js')
	<script src="{{ asset('custom/js/component/suggest-booking-pitchs.js') }}"></script>
@endpush