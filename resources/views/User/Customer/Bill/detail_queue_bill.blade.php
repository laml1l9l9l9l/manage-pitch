@extends('Layout.Customer.User.master')
@push('css')
	<title>
		{{ __('Chi tiết hóa đơn tạm') }}
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
                        	<h2 class="title">{{ __('Thông tin chi tiết') }}</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning"></div>
						@include('Layout.Customer.Notification.message_basic')
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="card card-raised card-profile">
								<div class="card-content">
									<div class="col-md-12">
										<h3 class="card-title">
											{{ __($bill->code) }}
										</h3>
									</div>
									<div class="col-md-12">
										<hr>
									</div>
									<div class="col-md-12">
										<h5 class="decription my-0">
											{{ __('Trạng thái: ') }}
											<span class="{{ __($model_bill->class_color_status_model[$bill->status]) }}">
												{{ __($model_bill->status_model[$bill->status]) }}
											</span>
										</h5>
									</div>
									<div class="col-md-12">
										<hr>
									</div>
									<div class="col-md-12">
										<h5 class="decription my-0">
											{{ __('Đặt cọc: '.number_format($bill->down_payment).' VNĐ') }}
										</h5>
									</div>
									<div class="col-md-12">
										<hr>
									</div>
									<div class="col-md-12">
										<h5 class="decription my-0">
											{{ __('Thành tiền: '.number_format($bill->into_money).' VNĐ') }}
										</h5>
									</div>
									<div class="col-md-12">
										<hr>
									</div>
									<div class="col-md-12">
										<h5 class="decription mt-0">
											{{ __( 'Ngày tạo: '.date('H:i, d-m-Y', strtotime($bill->created_at)) ) }}
										</h5>
									</div>
								</div>{{-- end card-content --}}
							</div>
						</div>
					</div>{{-- end row --}}


					<div class="row">
						<div class="col-md-12">
							<h3 class="title">
								{{ __('Tổng hóa đơn chi tiết: '.count($detail_bills)) }}
							</h3>
						</div>
					</div>

					<div class="row">

						@foreach ($detail_bills as $detail_bill)
							@php
								$price_special_date_time = $model_special_datetime->getPriceSpecialDateTime($detail_bill->id_time_slot, $detail_bill->soccer_day);
								$increase_price = $detail_bill->price - $detail_bill->price_pitch;
							@endphp
							<div class="col-md-6">
								<div class="card card-raised card-profile">
									<div class="card-content">
										<h3 class="card-title">
											{{ __('Thời gian thuê: '.$detail_bill->name_time_slot.', '.date('d-m-Y', strtotime($detail_bill->soccer_day)) ) }}
										</h3>
										<p class="card-description">
											{{ __($detail_bill->name_pitch.' - '.number_format($detail_bill->price_pitch).' VNĐ') }}
										</p>
										<hr>
										<h4>
											{{ __('Tăng giá') }}
										</h4>
										<p class="card-description">
											{{ __('Ngày đặc biệt: ') }}
											@if(!empty($price_special_date_time['increase_price_date'])){{ __('+') }}@endif
											{{ __(number_format($price_special_date_time['increase_price_date']).' VNĐ') }}
										</p>
										<p class="card-description">
											{{ __('Giờ đặc biệt: ') }}
											@if(!empty($price_special_date_time['increase_price_time'])){{ __('+') }}@endif
											{{ __(number_format($price_special_date_time['increase_price_time']).' VNĐ') }}
										</p>
										<p class="card-description">
											{{ __('Ngày giờ đặc biệt: ') }}
											@if(!empty($price_special_date_time['increase_price_date_time'])){{ __('+') }}@endif
											{{ __(number_format($price_special_date_time['increase_price_date_time']).' VNĐ') }}
										</p>
										<h6>
											{{ __('Tổng phí thêm: ') }}
											@if(!empty($increase_price)){{ __('+') }}@endif
											{{ __(number_format($increase_price).' VNĐ') }}
										</h6>
										<hr>
										<h4>
											{{ __( 'Tổng tiền: '.number_format($detail_bill->price).' VNĐ' ) }}
										</h4>
									</div>
								</div>
							</div>
						@endforeach
						
						<div class="col-md-12 text-right">
							{{ $detail_bills->fragment('row-title-notice')->links() }}
						</div>
					</div>

				</div>{{-- end section --}}

			</div>

	    </div>

    </div>
@endsection