@extends('Layout.Customer.User.master')
@push('css')
	<title>
		{{ __('Hóa đơn tạm') }}
	</title>
@endpush

@section('content')
	<div class="blog-posts">
		
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg3.jpg') }});">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="title" id="title_page"></h2>
					</div>
				</div>
			</div>
		</div>

		<div class="main main-raised">
			<div class="container">

				<div class="section">
					<div class="row" id="row-title-notice">
						<div class="col-md-6 col-md-offset-3 text-center">
                        	<h2 class="title">{{ __('Danh sách hóa đơn') }}</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning"></div>
						@include('Layout.Customer.Notification.message_basic')
					</div>


					@if (count($visual_bill) > 0)


						<div class="row">

							@foreach ($visual_bill as $bill)
								@php
									$information = $bill->result;
								@endphp
								<div class="col-md-6">
									<div class="card card-raised card-profile">
										<div class="card-content">
											<h3 class="card-title">
												{{ __("Mã $bill->series") }}
											</h3>
											<hr>
											<p class="card-description">
												{{ __('Tổng tiền: ') }}
												<b>
													{{ __(number_format($information->amount).' VNĐ') }}
												</b>
											</p>
											<hr>
											<a href="{{ route('customer.bill.detail', ['id' => $bill->series]) }}" class="btn btn-primary btn-round">
												<i class="material-icons">format_align_left</i> {{ __('Xem chi tiết') }}
											</a>
										</div>
									</div>
								</div>
							@endforeach							
						</div>
					@else
						<div class="row">
							<h3 class="title text-center">
								{{ __('Bạn chưa có hóa đơn') }}
							</h3>
						</div>
					@endif

				</div>{{-- end section --}}

			</div>

	    </div>

    </div>
@endsection