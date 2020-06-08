@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Chi tiết khách hàng') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="{{ route('admin.date.store') }}">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thông tin khách hàng') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label for="name">
											{{ __('Tên khách hàng') }}
										</label>
										<input type="text" placeholder="Tên khách hàng" class="form-control" id="name" name="customer[name]" value="@if(!empty($customer->name)) {{ $customer->name }} @endif">
		                				@if (!empty($errors) && $errors->has('name'))
		                					<label class="error text-danger" for="name">
		                						{{ $errors->first('name') }}
		                					</label>
		                				@endif
		                			</div>
									<div class="col-md-4">
										<label for="phone">
											{{ __('Số điện thoại') }}
										</label>
										<input type="text" placeholder="Tên khách hàng" class="form-control" id="phone" name="customer[phone]" value="@if(!empty($customer->phone)) {{ $customer->phone }} @endif">
		                				@if (!empty($errors) && $errors->has('phone'))
		                					<label class="error text-danger" for="phone">
		                						{{ $errors->first('phone') }}
		                					</label>
		                				@endif
		                			</div>
									<div class="col-md-4">
										<label>
											{{ __('Trạng thái') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="customer[status]">
											@php
												Helpers::optionSelectArray($model_customer->status_model, (isset($customer->status) && $customer->status !== null) ? strval($customer->status) : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('status'))
		                					<label class="error text-danger">
		                						{{ $errors->first('status') }}
		                					</label>
		                				@endif
									</div>
		                		</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>
											{{ __('Email') }}
										</label>
										<input type="text" placeholder="Email" class="form-control" value="@if(!empty($customer->email)){{$customer->email}}@endif" disabled="disabled">
									</div>
									<div class="col-md-4">
										<label>
											{{ __('Ngày tạo') }}
										</label>
										<input type="text" placeholder="Ngày tạo" class="form-control" value="@if(!empty($customer->created_at)){{ date('H:i:s d-m-Y', strtotime($customer->created_at))}}@endif" disabled="disabled">
									</div>
									<div class="col-md-4">
										<label>
											{{ __('Ngày cập nhật') }}
										</label>
										<input type="text" placeholder="Ngày cập nhật" class="form-control" value="@if(!empty($customer->updated_at)){{ date('H:i:s d-m-Y', strtotime($customer->updated_at))}}@endif" disabled="disabled">
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-fill btn-info">
								{{ __('Chỉnh sửa') }}
							</button>
						</div>
					</form>
				</div> <!-- end card -->
			</div>

		</div> <!-- end row -->


		{{-- Bill --}}
		@if (count($bills) > 0)
			<div class="row">
				<div class="col-md-12">
					<h2>
						{{ __('Tổng hóa đơn: '.count($bills)) }}
					</h2>
				</div>
			</div>
			<div class="row">
				
				@foreach ($bills as $bill)
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									{{ __('Hóa đơn - '.$bill->code) }}
									<div class="pull-right">
										<a href="{{ route('admin.bill.detail', ['id' => $bill->id]) }}" class="btn">
											{{ __('Chi tiết') }}
										</a>
									</div>
								</h4>
							</div>
							<div class="card-content mt-3">
								<div class="row">
									<div class="col-md-12">
										{{ __('Trạng thái: ') }}
										<div class="pull-right">
											<strong class="{{$model_bill->class_color_status_model[$bill->status]}}">
												{{ $model_bill->status_model[$bill->status] }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										{{ __('Tiền đặt cọc: ') }}
										<div class="pull-right">
											<strong>
												{{ number_format($bill->down_payment).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										{{ __('Ngày tạo: ') }}
										<div class="pull-right">
											<strong>
												{{ date('H:i:s d-m-Y', strtotime($bill->created_at)) }}
											</strong>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
											{{ __('Thành tiền: ') }}
											<strong>
												{{ number_format($bill->into_money).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach

			</div>{{-- end row --}}

			<div class="row">
				<div class="text-right">
					{{ $bills->links() }}
				</div>
			</div>
		@endif

	</div>
</div>
@endsection