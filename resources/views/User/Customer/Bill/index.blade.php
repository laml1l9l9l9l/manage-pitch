@extends('Layout.Customer.User.master')
@push('css')
	<title>
		{{ __('Hóa đơn') }}
	</title>
@endpush

@section('content')
	<div class="blog-posts">
		
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg3.jpg') }});">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="title" id="title_page">
							{{-- {{ __('Rèn luyện thể thao, đẩy lùi dịch bệnh') }} --}}
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
                        	<h2 class="title">{{ __('Danh sách hóa đơn') }}</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning"></div>
						@include('Layout.Customer.Notification.message_basic')
					</div>


					@if (count($bills) > 0)
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-3 text-center">
									<h5 class="decription">
										{{ __('Hóa đơn: '.$count_bills['count_bills']) }}
									</h5>
								</div>
								<div class="col-md-3 text-center">
									<h5 class="decription text-danger">
										{{ __('Hóa đơn chưa đặt cọc: '.$count_bills['count_unpaid_bills']) }}
									</h5>
								</div>
								<div class="col-md-3 text-center">
									<h5 class="decription text-warning">
										{{ __('Hóa đơn đã đặt cọc: '.$count_bills['count_deposited_bills']) }}
									</h5>
								</div>
								<div class="col-md-3 text-center">
									<h5 class="decription text-success">
										{{ __('Hóa đơn đã thanh toán: '.$count_bills['count_paid_bills']) }}
									</h5>
								</div>
							</div>
						</div>


						<div class="row">

							@foreach ($bills as $bill)
								<div class="col-md-6">
									<div class="card card-raised card-profile">
										<div class="card-content">
											<h6 class="category text-danger
											">{{ __('Chưa đặt cọc') }}</h6>
											<h3 class="card-title">
												{{ __($bill->code) }}
											</h3>
											<p class="card-description">
												{{ __('Phí thêm: '.number_format($bill->down_payment).' VNĐ') }}
											</p>
											<hr>
											<p class="card-description">
												{{ __('Thành tiền: '.number_format($bill->into_money).' VNĐ') }}
											</p>
											<hr>
											<p class="card-description">
												{{ __( 'Ngày tạo: '.date('H:i, d-m-Y', strtotime($bill->created_at)) ) }}
											</p>
											<a href="#pablo" class="btn btn-primary btn-round">
												<i class="material-icons">format_align_left</i> {{ __('Xem chi tiết') }}
											</a>
										</div>
									</div>
								</div>
							@endforeach
							
							<div class="col-md-12 text-right">
								{{ $bills->links() }}
							</div>
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