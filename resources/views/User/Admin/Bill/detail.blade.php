@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Chi tiết hóa đơn') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="{{ route('admin.bill.update', ['id' => $bill->id]) }}">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thông tin hóa đơn') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label for="code">
											{{ __('Mã hóa đơn') }}
										</label>
										<input type="text" placeholder="Mã hóa đơn" class="form-control" id="code" value="@if(!empty($bill->code)) {{ $bill->code }} @endif" disabled="disabled">
		                			</div>
									<div class="col-md-4">
										<label>
											{{ __('Trạng thái') }}
										</label>
										<select class="selectpicker" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="bill[status]">
											@php
												Helpers::optionSelectArray($model_bill->status_model, (isset($bill->status) && $bill->status !== null) ? strval($bill->status) : '' );
											@endphp
										</select>
		                				@if (!empty($errors) && $errors->has('status'))
		                					<label class="error text-danger">
		                						{{ $errors->first('status') }}
		                					</label>
		                				@endif
									</div>
									<div class="col-md-4">
										<label for="phone">
											{{ __('Tên khách hàng') }}
										</label>
										<p>
											<a href="{{ route('admin.customer.detail', [ 'id' => $bill->id_customer]) }}">
												{{ __($bill->name) }}
											</a>
										</p>
		                			</div>
		                		</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>
											{{ __('Tiền đặt cọc') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="Tiền đặt cọc" class="form-control text-right" value="@if(!empty($bill->down_payment)) {{ number_format($bill->down_payment) }} @else {{ __(0) }} @endif" disabled="disabled">
											<span class="input-group-addon">
												{{ __('VNĐ') }}
											</span>
										</div>
									</div>
									<div class="col-md-3">
										<label>
											{{ __('Thành tiền') }}
										</label>
										<div class="input-group">
											<input type="text" placeholder="Thành tiền" class="form-control text-right" value="@if(!empty($bill->into_money)) {{ number_format($bill->into_money) }} @else {{ __(0) }}  @endif" disabled="disabled">
											<span class="input-group-addon">
												{{ __('VNĐ') }}
											</span>
										</div>
									</div>
									<div class="col-md-3">
										<label>
											{{ __('Ngày tạo') }}
										</label>
										<input type="text" placeholder="Ngày tạo" class="form-control" value="@if(!empty($bill->created_at)){{ date('H:i:s d-m-Y', strtotime($bill->created_at))}}@endif" disabled="disabled">
									</div>
									<div class="col-md-3">
										<label>
											{{ __('Ngày cập nhật') }}
										</label>
										<input type="text" placeholder="Ngày cập nhật" class="form-control" value="@if(!empty($bill->updated_at)){{ date('H:i:s d-m-Y', strtotime($bill->updated_at))}}@endif" disabled="disabled">
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
		@if (count($detail_bills) > 0)
			<div class="row">
				<div class="col-md-12">
					<h2>
						{{ __('Tổng hóa đơn chi tiết: '.count($detail_bills)) }}
					</h2>
				</div>
			</div>
			<div class="row">
				
				@foreach ($detail_bills as $detail_bill)
					@php
						$price_special_date_time = $model_special_datetime->getPriceSpecialDateTime($detail_bill->id_time_slot, $detail_bill->soccer_day);
						$increase_price = $detail_bill->price - $detail_bill->price_pitch;
					@endphp
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									{{ __('Thời gian thuê: '.$detail_bill->name_time_slot.', '.date('d-m-Y', strtotime($detail_bill->soccer_day)) ) }}
								</h4>
							</div>
							<div class="card-content mt-3">
								<div class="row">
									<div class="col-md-12">
										{{ __('Tên sân: ') }}
										<div class="pull-right">
											<strong>
												{{ __($detail_bill->name_pitch) }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										{{ __('Giá sân: ') }}
										<div class="pull-right">
											<strong>
												{{ number_format($detail_bill->price_pitch).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										{{ __('Ngày đặc biệt: ') }}
										<div class="pull-right">
											<strong>
												@if(!empty($price_special_date_time['increase_price_date'])){{ __('+') }}@endif
												{{ number_format($price_special_date_time['increase_price_date']).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										{{ __('Giờ đặc biệt: ') }}
										<div class="pull-right">
											<strong>
												@if(!empty($price_special_date_time['increase_price_time'])){{ __('+') }}@endif
												{{ number_format($price_special_date_time['increase_price_time']).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										{{ __('Ngày giờ đặc biệt: ') }}
										<div class="pull-right">
											<strong>
												@if(!empty($price_special_date_time['increase_price_date_time'])){{ __('+') }}@endif
												{{ number_format($price_special_date_time['increase_price_date_time']).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-12">
										{{ __('Tổng phí thêm: ') }}
										<div class="pull-right">
											<strong>
												@if(!empty($increase_price)){{ __('+') }}@endif
												{{ number_format($increase_price).' VNĐ' }}
											</strong>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
											{{ __('Tổng tiền: ') }}
											<strong>
												{{ number_format($detail_bill->price).' VNĐ' }}
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
					{{ $detail_bills->links() }}
				</div>
			</div>
		@endif

		<div class="row">
			<div class="col-md-12">
				<h2>
					{{ __('Lịch sử thay đổi') }}
				</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					@if (count($history_bill) > 0)
						<table class="table">
							<tr>
								<th>
									{{ __('Email admin') }}
								</th>
								<th>
									{{ __('Thay đổi') }}
								</th>
								<th>
									{{ __('Ngày thay đổi') }}
								</th>
							</tr>
							@foreach ($history_bill as $bill)
								<tr>
									<td>
										{{ $bill->email_admin }}
									</td>
									<td>
										{{ $bill->log_change }}
									</td>
									<td>
										{{ date('d-m-Y', strtotime($bill->created_at)) }}
									</td>
								</tr>
							@endforeach
						</table>
					@else
						<div class="text-center">
							<h3 class="py-5">
								{{ __('Chưa có lịch sử') }}
							</h3>
						</div>
					@endif
				</div>
			</div>
		</div>

	</div>
</div>
@endsection