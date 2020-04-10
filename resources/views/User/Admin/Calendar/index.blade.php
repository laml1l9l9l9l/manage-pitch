@extends('Layout.Admin.User.master')

@push('css')
    <title>
        {{ __('Lịch thuê') }}
    </title>
@endpush

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="card card-calendar">
            <div class="card-content">
                <div id="fullCalendar"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            custom.initFullCalendar();
        });
    </script>
@endpush