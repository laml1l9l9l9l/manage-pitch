@extends('Layout.Customer.master')
@push('css')
	<title>
		{{ __('Trang chủ') }}
	</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/fullcalendar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('custom/css/custom-fullcalendar.css') }}">
@endpush

@section('content')
	<div class="blog-posts">
		
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url({{ asset('custom/img/bg-football-ground.jpg') }});">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="title">
							{{ __('Rèn luyện thể thao, đẩy lùi dịch bệnh') }}
						</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="main main-raised">
			<div class="container">

				<div class="section">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
                        	<h2 class="title">{{ __('Thuê sân bóng') }}</h2>
							<div class="tab-space" id="row-title"></div>

						</div>
					</div>

					{{-- Calendar --}}
					<div class="row" id="row-calendar">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn ngày thuê') }}</h3>
                        </div>
                        <div id="calendar"></div>
						<div class="tab-space"></div>
					</div>


					<div class="row d-none" id="row-pitch">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn sân thuê') }}</h3>
                        </div>
						@foreach ($pitchs as $pitch)
							<div class="col-md-6 text-center">
								@php
									$path_image = str_replace('public', 'storage', $pitch->image);
								@endphp
								<div class="img-container">
									<img src="{{ asset($path_image) }}" class="img-raised rounded img-custom img-pitch" data-pitch="{{ $pitch->id }}">
								</div>
								<h3>
									{{ __($pitch->name) }}
								</h3>
							</div>
						@endforeach

						<div class="col-md-12 text-center">
							<button class="btn btn-round" id="return-select-date">
								<i class="fa fa-undo"></i> {{ __('Quay lại') }}
							</button>
						</div>
					</div>

					<div class="row row-container d-none" id="row-time">
                        <div class="text-center">
                        	<h3 class="info-title">{{ __('Chọn khung giờ thuê') }}</h3>
                        </div>
						<div class="col-md-offset-3 col-md-6 text-center">
							<select class="selectpicker" data-style="btn btn-primary btn-round" title="{{ __('Chọn thời gian thuê') }}" data-size="7">
								@php
									Helpers::optionSelectBasic($time_slots, '');
								@endphp
							</select>
						</div>

						<div class="col-md-12 text-center">
							<button class="btn btn-round" id="return-select-pitch">
								<i class="fa fa-undo"></i> {{ __('Quay lại') }}
							</button>
						</div>
					</div>

					
					<div class="d-none">
						<form class="d-none" method="POST" action="#" id="form-create-bill">
							@csrf
							<input type="hidden" class="d-none" id="date-rent" name="bill[date]">
							<input type="hidden" class="d-none" id="pitch-rent" name="bill[pitch]">
							<input type="hidden" class="d-none" id="time-slot-rent" name="bill[time_slot]">
						</form>
					</div>


					<div class="row">

						<div class="col-md-6">
							<div class="card card-raised card-background" style="background-image: url('../assets/img/examples/office2.jpg')">
								<div class="card-content">
									<h6 class="category text-info">Worlds</h6>
									<a href="#pablo">
										<h3 class="card-title">The Best Productivity Apps on Market</h3>
									</a>
									<p class="card-description">
										Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
									</p>
									<a href="#pablo" class="btn btn-danger btn-round">
										<i class="material-icons">format_align_left</i> Read Article
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card card-raised card-background" style="background-image: url('../assets/img/examples/blog8.jpg')">
								<div class="card-content">
									<h6 class="category text-info">Business</h6>
									<h3 class="card-title">Working on Wallstreet is Not So Easy</h3>
									<p class="card-description">
										Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
									</p>
									<a href="#pablo" class="btn btn-primary btn-round">
										<i class="material-icons">format_align_left</i> Read Article
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="card card-raised card-background" style="background-image: url('../assets/img/examples/card-project6.jpg')">
								<div class="card-content">
									<h6 class="category text-info">Marketing</h6>
									<h3 class="card-title">0 to 100.000 Customers in 6 months</h3>
									<p class="card-description">
										Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
									</p>
									<a href="#pablo" class="btn btn-warning btn-round">
										<i class="material-icons">subject</i> Read Case Study
									</a>
									<a href="#pablo" class="btn btn-white btn-just-icon btn-simple" title="Save to Pocket" rel="tooltip">
										<i class="fa fa-get-pocket"></i>
									</a>

								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="section">
					<h3 class="title text-center">You may also be interested in</h3>
					<br />
					<div class="row">
						<div class="col-md-4">
							<div class="card card-plain card-blog">
								<div class="card-image">
									<a href="#pablo">
										<img class="img img-raised" src="../assets/img/bg5.jpg" />
									</a>
								</div>

								<div class="card-content">
									<h6 class="category text-info">Enterprise</h6>
									<h4 class="card-title">
										<a href="#pablo">Autodesk looks to future of 3D printing with Project Escher</a>
									</h4>
									<p class="card-description">
										Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses.<a href="#pablo"> Read More </a>
									</p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-plain card-blog">
								<div class="card-image">
									<a href="#pablo">
										<img class="img img-raised" src="../assets/img/examples/blog5.jpg" />
									</a>
								</div>
								<div class="card-content">
									<h6 class="category text-success">
										Startups
									</h6>
									<h4 class="card-title">
										<a href="#pablo">Lyft launching cross-platform service this week</a>
									</h4>
									<p class="card-description">
										Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses.<a href="#pablo"> Read More </a>
									</p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-plain card-blog">
								<div class="card-image">
									<a href="#pablo">
										<img class="img img-raised" src="../assets/img/examples/blog6.jpg" />
									</a>
								</div>

								<div class="card-content">
									<h6 class="category text-danger">
										<i class="material-icons">trending_up</i> Enterprise
									</h6>
									<h4 class="card-title">
										<a href="#pablo">6 insights into the French Fashion landscape</a>
									</h4>
									<p class="card-description">
										Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses.<a href="#pablo"> Read More </a>
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="team-5 section-image" style="background-image: url('{{ asset('custom/img/bg10.jpg') }}')">

				<div class="container">
					<div class="row">

						<div class="col-md-6">
							<div class="card card-profile card-plain">
								<div class="col-md-5">
									<div class="card-image">
										<a href="#pablo">
											<img class="img" src="../assets/img/faces/card-profile1-square.jpg" />
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="card-content">
										<h4 class="card-title">Alec Thompson</h4>
										<h6 class="category text-muted">Author of the Month</h6>

										<p class="card-description">
											Don't be scared of the truth because we need to restart the human foundation in truth...
										</p>

										<div class="footer">
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-twitter"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-facebook-square"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-google"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card card-profile card-plain">
								<div class="col-md-5">
									<div class="card-image">
										<a href="#pablo">
											<img class="img" src="../assets/img/faces/card-profile4-square.jpg" />
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="card-content">
										<h4 class="card-title">Kendall Andrew</h4>
										<h6 class="category text-muted">Author of the Week</h6>

										<p class="card-description">
											Don't be scared of the truth because we need to restart the human foundation in truth...
										</p>

										<div class="footer">
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-linkedin"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-facebook-square"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-dribbble"></i></a>
											<a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i class="fa fa-google"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>

			<div class="subscribe-line">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h3 class="title">Get Tips & Tricks every Week!</h4>
							<p class="description">
								Join our newsletter and get news in your inbox every week! We hate spam too, so no worries about this.
							</p>
						</div>
						<div class="col-md-6">
							<div class="card card-plain card-form-horizontal">
								<div class="card-content">
									<form method="" action="">
										<div class="row">
											<div class="col-md-8">

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">mail</i>
													</span>
													<input type="email" value="" placeholder="Your Email..." class="form-control" />
												</div>
											</div>
											<div class="col-md-4">
												<button type="button" class="btn btn-primary btn-round btn-block">Subscribe</button>
											</div>
										</div>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
	    </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('custom/js/fullcalendar.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        {{-- Calendar --}}
        $(document).ready(function() {
            var dateObj   = new Date();
            var momentObj = moment(dateObj);
            
            var start_day = new Date(dateObj.getFullYear(), dateObj.getMonth() - 1, 0);
            var end_day   = new Date(dateObj.getFullYear(), dateObj.getMonth() + 1, 0);

            $('#calendar').fullCalendar({
                height: 1000,
                defaultView: 'month',
                validRange: {
                    start: start_day,
                    end: end_day
                },
                defaultDate: momentObj,
                showNonCurrentDates: true,
                header:{
                    left:   'title',
                    center: 'today prev,next',
                    right:  'month' //agendaWeek,agendaDay - xem theo tuần, ngày
                },
                buttonText: {
                    today: 'Hôm nay',
                    month: 'Nhấn vào ngày',
                    // agendaDay: 'Lịch Theo Ngày',
                },
                events: {
                    url: '{{-- route('customer.load_calendar') --}}',
                    type: 'GET'
                },
                monthNames: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
                monthNamesShort: ['Th 1','Th 2','Th 3','Th 4','Th 5','Th 6','Th 7','Th 8','Th 9','Th 10','Th 11','Th 12'],
                dayNames:['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
                dayNamesShort:['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

                // Event click date
                dayClick: function(date, jsEvent, view) {
					// Show select pitch
					$('#row-calendar').addClass('d-none')
					if($('#row-pitch').hasClass('d-none')){
						$('#row-pitch').removeClass('d-none');
					}

					var row_title = document.getElementById('row-title');
					row_title.scrollIntoView({behavior: "smooth"});

                	// get date to form
					var rent_date = $(this).attr('data-date');
					$('#date-rent').val(rent_date);
		        }
            });
            
            $('#calendar').find('table').addClass('table-responsive');
        });

    </script>

	{{-- Process rent football field --}}
    <script type="text/javascript">
    	$(document).ready(function() {
			// Return show select date
    		$('#return-select-date').click(function() {
				$('#row-pitch').addClass('d-none')
				if($('#row-calendar').hasClass('d-none')){
					$('#row-calendar').removeClass('d-none');
				}

				titleScrollIntoView();
    		});

    		$('#return-select-pitch').click(function() {
				$('#row-time').addClass('d-none')
				if($('#row-pitch').hasClass('d-none')){
					$('#row-pitch').removeClass('d-none');
				}

				titleScrollIntoView();
    		});


    		// Select pitch
    		$('.img-pitch').click(function() {
				$('#row-pitch').addClass('d-none')
				if($('#row-time').hasClass('d-none')){
					$('#row-time').removeClass('d-none');
				}

				titleScrollIntoView();


            	// get pitch to form
				var rent_pitch = $(this).attr('data-pitch');
				$('#pitch-rent').val(rent_pitch);
    		});

    		function titleScrollIntoView() {
				var row_title = document.getElementById('row-title');
				row_title.scrollIntoView({behavior: "smooth"});
    		}
    	});
    </script>
@endpush