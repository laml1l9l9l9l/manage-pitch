@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Hóa đơn') }}
	</title>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-12 card">
				<form action="" method="GET">
					<div class="col-md-12 p-0">
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Tìm kiếm') }}
							</h4>
						</div>
						<div class="row card-content card-form-input collapse" id="form-search">
							<div class="col-md-4">
								<div class="form-group">
									<label for="name-customer">
										{{ __('Khách hàng') }}
									</label>
									<input type="text" placeholder="Họ và tên" class="form-control" id="name-customer" name="bill[name]" value="@if(!empty($request_bill['name'])){{ $request_bill['name'] }}@endif">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="status-bill">
										{{ __('Trạng thái') }}
									</label>
									<select class="selectpicker" id="status-bill" data-style="btn btn-block" title="Chọn trạng thái" data-size="5" name="bill[status]">
										@php
											Helpers::optionSelectArray($model_bill->status_model, (isset($request_bill['status']) && $request_bill['status'] !== null) ? $request_bill['status'] : '' );
										@endphp
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="create-date-bill">
										{{ __('Ngày tạo') }}
									</label>
									<div class="form-inline custom-form-inline">
										<input type="date" placeholder="select" class="form-control" id="create-date-bill" name="bill[start_created_at]" value="@if(!empty($request_bill['start_created_at'])){{ $request_bill['start_created_at'] }}@endif">
										-
										<input type="date" placeholder="select" class="form-control" id="create-date-bill" name="bill[end_created_at]" value="@if(!empty($request_bill['end_created_at'])){{ $request_bill['end_created_at'] }}@endif">
									</div>
								</div>
							</div>
						</div>
						<div class="card-content card-form-btn">
							<div class="form-btn">
								<a href="{{ route('admin.bill') }}" class="btn btn-fill btn-wd" id="btn-reset">
									<i class="ti-reload"></i>
									{{ __('Làm mới') }}
								</a>
							</div>
							<div class="form-btn">
								<a href="#form-search" class="btn btn-info btn-fill btn-wd collapsed" id="btn-expand" data-toggle="collapse">
									<i class="ti-angle-down"></i>
									{{ __('Mở rộng') }}
								</a>
							</div>
							<div class="form-btn">
								<button class="btn btn-primary btn-fill btn-wd" type="submit">
									<i class="ti-search"></i>
									{{ __('Tìm kiếm') }}
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>

		<div class="row">


			<div class="col-md-12 card">

				<div class="card-header">
					<h4 class="card-title">{{ __('Hóa Đơn') }}</h4>
				</div>

				<div class="card-content">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-bold">
									<th class="text-center">#</th>
									<th>{{ __('Mã') }}</th>
									<th>{{ __('Khách hàng') }}</th>
									<th class="text-right">{{ __('Tiền đặt cọc') }}</th>
									<th class="text-right">{{ __('Thành tiền') }}</th>
									<th class="text-right">{{ __('Trạng thái') }}</th>
									<th class="text-right">{{ __('Ngày tạo') }}</th>
									<th class="text-right">{{ __('Thao Tác') }}</th>
								</tr>
							</thead>
							<tbody>
								@if (count($bills) > 0)
									@foreach ($bills as $bill)
										@php
											$customer = $model_bill->getCustomer($bill->id_customer);
										@endphp
										<tr>
											<td class="text-center">{{ $page_bill }}</td>
											<td>
												{{ __($bill->code) }}
											</td>
											<td>
												{{ __($customer->name) }}
											</td>
											<td class="text-right">
												{{ number_format($bill->down_payment) }}
											</td>
											<td class="text-right">
												{{ number_format($bill->into_money) }}
											</td>
											<td class="text-right">
												{{ __($model_bill->status_model[$bill->status]) }}
											</td>
											<td class="text-right">
												{{ date('d-m-Y H:i', strtotime($bill->created_at)) }}
											</td>
											<td class="td-actions text-right">
												<a href="{{ route('admin.bill.detail',['id' => $bill->id]) }}" type="button" rel="tooltip" title="Chi tiết" class="btn btn-info btn-simple btn-xs">
													<i class="fa fa-file"></i>
												</a>
												<button type="button" rel="tooltip" title="Hủy" class="btn btn-danger btn-simple btn-xs btn-delete" data-toggle="modal" data-target="#confirmDelete" data-id-item="{{ __($bill->id) }}">
													<i class="fa fa-times"></i>
												</button>
											</td>
										</tr>
										@php
											$page_bill++
										@endphp
									@endforeach
								@else
									<td class="text-center" colspan="8">
										<h4 class="my-3">
											{{ __('Chưa có thời gian') }}
										</h4>
									</td>
								@endif
							</tbody>
						</table>
					</div>

					<div class="text-right">
						{{ $bills->appends($request)->links() }}
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- Modal confirm delete -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header d-flex">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Xác nhận') }}</h5>
				<button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ __('Bạn có muốn xóa?') }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Đóng') }}</button>
				<a type="button" class="btn btn-danger" id="btn-delete-item">{{ __('Xóa') }}</a>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
	<script type="text/javascript">
		var urlDeleteItem = '{{ route('admin.bill.delete', ['id' => 0]) }}';
	</script>
	<script src="{{ asset('admin/js/custom-js/modal-confirm.js') }}"></script>
@endpush