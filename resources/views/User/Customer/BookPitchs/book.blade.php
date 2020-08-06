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
								{{ __('Kiểm tra hóa đơn đặt giải') }}
                        	</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning">
							@include('Layout.Customer.Notification.message_basic')
						</div>
					</div>
					
					@if($total_bill)
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-md-center">
								<div class="col-md-12">
									<div class="border-lg border-primary border-rounded py-5">
										<div class="row my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Tổng số hóa đơn:') }}</h4>
												</div>
												<div class="col-md-4">
													<b>{{ __(count($total_bill->total_detail_bill)) }}</b>
												</div>
											</div>
										</div>
										<hr class="mx-5 my-0">
										<div class="row my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Tổng ngày thuê:') }}</h4>
												</div>
												<div class="col-md-4">
													{{ __(count($total_bill->total_dates)) }}
												</div>
											</div>
										</div>
										<hr class="mx-5 my-0">
										<div class="row my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Tổng khung giờ thuê:') }}</h4>
												</div>
												<div class="col-md-4">
													{{ __(count($total_bill->total_time_slots)) }}
												</div>
											</div>
										</div>
										<hr class="mx-5 my-0">
										<div class="my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Tổng Sân:') }}</h4>
												</div>
												<div class="col-md-4">
													{{ __(count($total_bill->total_pitchs)) }}
												</div>
											</div>
										</div>
										<hr class="mx-5 my-0">
										<div class="my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Tổng tiền:') }}</h4>
												</div>
												<div class="col-md-4">
													<b>
														{{ __(number_format($total_bill->total_amount).' VNĐ') }}
													</b>
												</div>
											</div>
										</div>
										<div class="m-0 text-center">
											<form method="post" action="{{ route('customer.book.pitchs') }}">
												@csrf
												<button type="submit" class="btn btn-info" id="book-pitch">
													{{ __('Xác nhận') }}
												</button>
												<a href="{{ route('customer.check.book.pitchs') }}" class="btn">
													<i class="fa fa-undo"></i>
													{{ __('Quay lại') }}
												</a>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-space"></div>
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<h3 class="title text-center">
									{{ __('Hóa đơn con') }}
								</h3>
							</div>
							<div class="tab-space"></div>
							<div class="col-md-8 col-md-offset-2">
								@foreach ($total_bill->total_detail_bill as $detail_bill)
									<div class="col-md-6">
										<div class="card card-raised card-profile">
											<div class="card-content">
												<h3 class="card-title">
													{{ __('Thời gian thuê: '.$detail_bill->name_time.', '.date('d-m-Y', strtotime($detail_bill->date)) ) }}
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
													{{ __(number_format($detail_bill->increase_price_date).' VNĐ') }}
												</p>
												<p class="card-description">
													{{ __('Giờ đặc biệt: ') }}
													@if(!empty($price_special_date_time['increase_price_time'])){{ __('+') }}@endif
													{{ __(number_format($detail_bill->increase_price_time).' VNĐ') }}
												</p>
												<p class="card-description">
													{{ __('Ngày giờ đặc biệt: ') }}
													@if(!empty($price_special_date_time['increase_price_date_time'])){{ __('+') }}@endif
													{{ __(number_format($detail_bill->increase_price_date_time).' VNĐ') }}
												</p>
												<h6>
													{{ __('Tổng phí thêm: ') }}
													@if(!empty($increase_price)){{ __('+') }}@endif
													{{ __(number_format($detail_bill->increase_price).' VNĐ') }}
												</h6>
												<hr>
												<h4>
													{{ __( 'Tổng tiền: '.number_format($detail_bill->amount).' VNĐ' ) }}
												</h4>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					@else
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center">
								<h4>
									{{ __('Không có hóa đơn vui lòng quay lại') }}
								</h4>
								<a href="{{ route('customer.check.book.pitchs') }}" class="btn">
									<i class="fa fa-undo"></i>
									{{ __('Quay lại') }}
								</a>
							</div>
						</div>
					@endif
				</div>{{-- end section --}}

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