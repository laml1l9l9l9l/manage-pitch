@extends('Layout.Customer.User.master')
@push('css')
	<title>
		{{ __('Xác nhận đặt sân') }}
	</title>
@endpush

@section('content')
	<div class="blog-posts">

		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg-football-ground.jpg') }});">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="title">
							{{ __('Xác nhận đặt sân') }}
						</h2>
					</div>
				</div>
			</div>
		</div>
		
		<div class="main main-raised">
			<div class="container">

				<div class="section">
					<div class="row" id="row-title-notice">
						<div class="col-md-8 col-md-offset-2 text-md-center">
                        	<h2 class="title">
								{{ __('Thông tin hóa đơn') }}
                        	</h2>
							<div class="tab-space" id="row-title"></div>

							@include('Layout.Customer.Notification.message_basic')

							<div class="col-md-12">
								@if(!empty($data_response))
									<div class="border-lg border-primary border-rounded py-5">
										<div class="row my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Ngày:') }}</h4>
												</div>
												<div class="col-md-4">
													{{ __($data_response->date) }}
												</div>
											</div>
										</div>
										<hr class="mx-5 my-0">
										<div class="row my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Khung giờ:') }}</h4>
												</div>
												<div class="col-md-4">
													{{ __($data_response->time) }}
												</div>
											</div>
										</div>
										<hr class="mx-5 my-0">
										<div class="my-2">
											<div class="d-flex align-items-center justify-content-between">
												<div class="col-md-6">
													<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Sân:') }}</h4>
												</div>
												<div class="col-md-4">
													{{ __($data_response->pitch) }}
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
														{{ __(number_format($data_response->amount).' VNĐ') }}
													</b>
												</div>
											</div>
										</div>
										<div class="m-0 text-center">
											<button type="submit" class="btn btn-info" id="book-pitch">
												{{ __('Xác nhận') }}
											</button>
											<a href="{{ route('customer.home') }}" class="btn">
												<i class="fa fa-undo"></i>
												{{ __('Quay lại') }}
											</a>
										</div>
									</div>

									<form id="create_bill">
										@csrf
									</form>
								@else
									<h4 class="text-center">
										{{ __('Thời điểm bạn chọn đã được thuê, vui lòng chọn lại hoặc xem gợi ý bên dưới') }}
									</h4>
									<a href="{{ route('customer.home') }}" class="btn">
										<i class="fa fa-undo"></i>
										{{ __('Quay lại') }}
									</a>
								@endif
							</div>

						</div> {{-- end col --}}
					</div> {{-- end row --}}

					<hr>

					<div class="row" id="row-title-notice">
						<div class="col-md-7 col-md-offset-2 text-md-center">
                        	<h3 class="title">
								{{ __('Gợi ý đặt sân') }}
                        	</h3>
							<div class="tab-space" id="row-title"></div>
							@if(!empty($data_response) || empty($data_suggest))
								<h4 class="text-center">
									{{ __('Không có gợi ý') }}
								</h4>
							@else
								@foreach ($data_suggest as $data_bill)
									<div class="border-lg border-primary border-rounded py-5">
										<form action="{{ route('customer.check.book.pitch') }}" method="POST">
											@csrf
											<div class="row my-2">
												<div class="d-flex align-items-center justify-content-between">
													<div class="col-md-6">
														<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Ngày:') }}</h4>
													</div>
													<div class="col-md-4">
														{{ __($data_bill->date_response) }}
													</div>
													<input type="hidden" class="d-none" name="bill[date]" value="{{ __($data_bill->date) }}">
												</div>
											</div>
											<hr class="mx-5 my-0">
											<div class="row my-2">
												<div class="d-flex align-items-center justify-content-between">
													<div class="col-md-6">
														<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Khung giờ:') }}</h4>
													</div>
													<div class="col-md-4">
														{{ __($data_bill->time_name) }}
													</div>
													<input type="hidden" class="d-none" name="bill[time_slot]" value="{{ __($data_bill->time) }}">
												</div>
											</div>
											<hr class="mx-5 my-0">
											<div class="my-2">
												<div class="d-flex align-items-center justify-content-between">
													<div class="col-md-6">
														<h4 class="card-title m-0" aria-describedby="selectDateHelp">{{ __('Sân:') }}</h4>
													</div>
													<div class="col-md-4">
														{{ __($data_bill->pitch_name) }}
													</div>
													<input type="hidden" class="d-none" name="bill[pitch]" value="{{ __($data_bill->pitch) }}">
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
															{{ __(number_format($data_bill->amount).' VNĐ') }}
														</b>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-info">
												{{ __('Đặt sân') }}
											</button>
											<a href="{{ route('customer.home') }}" class="btn">
												<i class="fa fa-undo"></i>
												{{ __('Quay lại') }}
											</a>
										</form>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>

			</div>{{-- end container --}}

	    </div>{{-- end main --}}
    </div>

@endsection

@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#book-pitch').click(() => {
				$('#create_bill').attr({
					method: 'post',
					action: '{{ route('customer.book.pitch') }}'
				});
				$('#create_bill').submit();
			});
		});
	</script>
@endpush