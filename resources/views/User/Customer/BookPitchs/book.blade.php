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

						@foreach ($date_time_booking as $data)
							@php
								// dd($data);
							@endphp
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
													{{ __('language.line') }}
												</p>
											</div>
											<div class="col-md-3">
												<p>
													<b>{{ __('Sân bóng') }}</b>
												</p>
												<p>
													{{ __('language.line') }}
												</p>
											</div>
											<div class="col-md-3">
												<p>
													<b>{{ __('Giá') }}</b>
												</p>
												<p>
													{{ __("language.line") }}
												</p>
											</div>
										</div>							
									</div>
								</div>
							</div>
						@endforeach

					</div>
				</div>

			</div>{{-- end container --}}

	    </div>{{-- end main --}}

    </div>
@endsection

@push('js')
	<script type="text/javascript">
		$('.card').on('click', function(){
		   	var checkbox = $(this).find('input[type="checkbox"]');
		   	checkbox.prop('checked', !checkbox.prop('checked'));
		});
	</script>
@endpush