@extends('Layout.Customer.User.master')
@push('css')
	<title>
		{{ __('Thông tin cá nhân') }}
	</title>
@endpush

@section('content')
	<div class="blog-posts">
		
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg8.jpg') }});">
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
                        	<h2 class="title">{{ __('Thông tin') }}</h2>
							<div class="tab-space" id="row-title"></div>
						</div>

						<div class="col-md-12 p-0" id="alert-select-warning"></div>
						@include('Layout.Customer.Notification.message_basic')
					</div>


					<div class="row">
						
						<form class="form" method="POST" action="{{ route('customer.profile.update') }}">
							@csrf
							<div class="col-md-8 col-md-offset-2">

								<div class="col-md-6">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" class="form-control" id="name" name="profile[name]" placeholder="Họ và tên..." value="{{ $account->name }}">
				                        @if (!empty($errors) && $errors->has('profile.name'))
				                            <label class="error text-danger" for="name">
				                                {{ $errors->first('profile.name') }}
				                            </label>
				                        @endif
									</div>
								</div>

								<div class="col-md-6">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">phone</i>
										</span>
										<input type="text" class="form-control" id="phone" name="profile[phone]" placeholder="Số điện thoại..." value="{{ $account->phone }}">
				                        @if (!empty($errors) && $errors->has('profile.phone'))
				                            <label class="error text-danger" for="phone">
				                                {{ $errors->first('profile.phone') }}
				                            </label>
				                        @endif
									</div>
								</div>

								<div class="col-md-6">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input type="email" class="form-control" id="email" placeholder="Email..." value="{{ $account->email }}" disabled="disabled">
									</div>
								</div>

								<div class="col-md-6">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">perm_identity</i>
										</span>
										<input type="text" class="form-control" placeholder="Trạng thái..." value="{{ $model_customer->status_model[$account->status] }}" disabled="disabled">
									</div>
								</div>

								<div class="col-md-12 text-center">
									<button class="btn btn-info">
										{{ __('Cập nhật') }}
									</button>
								</div>

							</div>
						</form>

					</div>{{-- end row --}}
				</div>

			</div>

	    </div>

    </div>
@endsection