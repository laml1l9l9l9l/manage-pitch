@extends('Layout.Admin.User.master')

@push('css')
    <title>
        {{ __('Trang chủ') }}
    </title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">

            @include('Layout.Admin.Notification.message_basic')
            
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="numbers pull-left">
                                        {{ __('Hóa đơn') }}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="pull-right">
                                        @if ($bill_statistical['percent'] !== null)
                                            <span class="label {{ __($bill_statistical['color_statistical']) }}">
                                                <i class="{{ __($bill_statistical['icon_statistical']) }}"></i>
                                                {{ __($bill_statistical['percent']."%") }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h6 class="big-title">{{ __('Tổng số') }} <span class="text-muted">{{ __('hóa đơn') }}</span> {{ __($bill_statistical['count']) }}</h6>
                            <div class="row">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between col-md-12">
                                        <div>{{ __('Chưa thanh toán: '.$bill_statistical['count_unpaid']) }}</div>
                                        -
                                        <div>{{ __('Đã đặt cọc: '.$bill_statistical['count_deposited']) }}</div>
                                        -
                                        <div>{{ __('Đã thanh toán: '.$bill_statistical['count_paid']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">
                                {{ __('Chi tiết') }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.bill') }}" class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="numbers pull-left">
                                        {{ __('Khách hàng') }}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="pull-right">
                                        {{-- <span class="label label-success">
                                            ? %
                                        </span> --}}
                                    </div>
                                </div>
                            </div>

                            <h6 class="big-title">{{ __('Tổng số') }} <span class="text-muted">{{ __('khách hàng') }}</span> {{ __($customer_statistical['count']) }}</h6>
                            <div class="row">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between col-md-6 col-md-offset-3">
                                        <div>{{ __('Hoạt động: '.$customer_statistical['count_acitve']) }}</div>
                                        -
                                        <div>{{ __('Khóa: '.$customer_statistical['count_lock']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">
                                {{ __('Chi tiết') }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.customer') }}" class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="numbers pull-left">
                                        {{ __('Tăng giá') }}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="pull-right">
                                        {{-- <span class="label label-warning">
                                            0%
                                        </span> --}}
                                    </div>
                                </div>
                            </div>
                            <h6 class="big-title">{{ __('Tổng số') }} <span class="text-muted">{{ __('thời điểm tăng giá') }}</span> {{ __($special_date_time_statistical['count']) }}</h6>
                            <div class="row">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between col-md-6 col-md-offset-3">
                                        <div>{{ __('Hoạt động: '.$special_date_time_statistical['count_acitve']) }}</div>
                                        -
                                        <div>{{ __('Khóa: '.$special_date_time_statistical['count_lock']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">
                                {{ __('Chi tiết') }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.specialdatetime') }}" class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="numbers pull-left">
                                        {{ __('Ngày nghỉ') }}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="pull-right">
                                        {{-- <span class="label label-danger">
                                            <i class="ti-arrow-down"></i>
                                            14%
                                        </span> --}}
                                    </div>
                                </div>
                            </div>
                            <h6 class="big-title">{{ __('Tổng số') }} <span class="text-muted">{{ __('ngày nghỉ') }}</span> {{ __($date_statistical['count']) }}</h6>
                            <div class="row">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between col-md-6 col-md-offset-3">
                                        <div>{{ __('Hoạt động: '.$date_statistical['count_lock']) }}</div>
                                        -
                                        <div>{{ __('Khóa: '.$date_statistical['count_acitve']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">
                                {{ __('Chi tiết') }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.date') }}" class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="numbers pull-left">
                                        {{ __('Sân bóng') }}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="pull-right">
                                    </div>
                                </div>
                            </div>
                            <h6 class="big-title">{{ __('Tổng số') }} <span class="text-muted">{{ __('sân bóng') }}</span> {{ __($pitch_statistical['count']) }}</h6>
                            <div class="row">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between col-md-6 col-md-offset-3">
                                        <div>{{ __('Hoạt động: '.$pitch_statistical['count_acitve']) }}</div>
                                        -
                                        <div>{{ __('Khóa: '.$pitch_statistical['count_lock']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">
                                {{ __('Chi tiết') }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.pitch') }}" class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="numbers pull-left">
                                        {{ __('Khung giờ') }}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="pull-right">
                                    </div>
                                </div>
                            </div>
                            <h6 class="big-title">{{ __('Tổng số') }} <span class="text-muted">{{ __('khung giờ') }}</span> {{ __($time_slots_statistical['count']) }}</h6>
                            <div class="row">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between col-md-6 col-md-offset-3">
                                        <div>{{ __('Hoạt động: '.$time_slots_statistical['count_acitve']) }}</div>
                                        -
                                        <div>{{ __('Khóa: '.$time_slots_statistical['count_lock']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">
                                {{ __('Chi tiết') }}
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.time') }}" class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3>
                        {{ __('Thống kê tài chính tháng') }}
                    </h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="icon-big icon-danger text-center">
                                        <i class="ti-receipt"></i>
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="numbers">
                                        <p>{{ __('Chưa thanh toán') }}</p>
                                        {{ number_format($bill_statistical['amount_unpaid']).' VNĐ' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('admin.bill').'?bill%5Bstatus%5D='.UNPAID }}">
                                    <i class="ti-search"></i> {{ __('Xem chi tiết') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-warning text-center">
                                        <i class="ti-write"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>{{ __('Đã đặt cọc') }}</p>
                                        {{ number_format($bill_statistical['amount_deposited']).' VNĐ' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('admin.bill').'?bill%5Bstatus%5D='.DEPOSITED }}">
                                    <i class="ti-search"></i> {{ __('Xem chi tiết') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>{{ __('Đã thanh toán') }}</p>
                                        {{ number_format($bill_statistical['amount_paid']).' VNĐ' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <a href="{{ route('admin.bill').'?bill%5Bstatus%5D='.PAID }}">
                                    <i class="ti-search"></i> {{ __('Xem chi tiết') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            demo.initOverviewDashboard();
            demo.initCirclePercentage();

        });
    </script>
@endpush