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
            url: '',
            type: 'GET'
        },
        monthNames: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
        monthNamesShort: ['Th 1','Th 2','Th 3','Th 4','Th 5','Th 6','Th 7','Th 8','Th 9','Th 10','Th 11','Th 12'],
        dayNames:['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
        dayNamesShort:['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

        // Event click date
        dayClick: function(date, jsEvent, view) {
        	// Validate date
			var rent_date = $(this).attr('data-date');

			var date  = new Date();
			var month = date.getMonth()+1;
			var day   = date.getDate();
			var full_day = date.getFullYear() + '-' +(month<10 ? '0' : '') + month + '-' +(day<10 ? '0' : '') + day;

            // Check date off
            var array_date_off = getDatesOff();
            var check_date_off = array_date_off.find(element => element == rent_date);

            if(check_date_off)
            {
                var message = 'Ngày này không hoạt động';
                showErrorWarning(message);
            }
			else if(new Date(rent_date) <= new Date(full_day))
			{
				var message = 'Ngày thuê phải lớn hơn ngày hiện tại';
				showErrorWarning(message);
			}
			else
			{
				// Show select pitch
				$('#row-calendar').addClass('d-none');
				if($('#row-pitch').hasClass('d-none')){
					$('#row-pitch').removeClass('d-none');
					animateOpacity('#row-pitch');
				}

				// Remove alert
				$('#alert-select-warning').empty();

				var row_title = document.getElementById('row-title');
				row_title.scrollIntoView({behavior: 'smooth'});

            	// Get date to form
				$('#date-rent').val(rent_date);
			}
        }
    });
    
    $('#calendar').find('table').addClass('table-responsive');

    // Add class date off
    checkDateOff();

    function checkDateOff() {
        var array_date_off = getDatesOff();
        for(var date of array_date_off){
            $('*[data-date="'+date+'"]').addClass('fc-day-off');
        }
    }

    function getDatesOff() {
        var date_off = null;

        $.ajax({
            async: false,
            url: urlGetDatesOff,
            type: 'GET',
            dataType: 'json',
            data: {},
            success: function(response) {
                date_off = response;
            }
        });

        return date_off;
    }

    function animateOpacity(selector) {
        $(selector).animate({opacity: "0.2"});
        $(selector).animate({opacity: "1"});
    }

    function showErrorWarning(message) {
        $('#alert-select-warning').empty();
        var row_title_notice = document.getElementById('row-title-notice');
        row_title_notice.scrollIntoView({behavior: 'smooth'});


        var alert_html = '<div class="alert alert-warning alert-rounded alert-message"><div class="alert-icon"><i class="material-icons">warning</i></div><h4 class="m-0" id="message">'+message+'</h4><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="material-icons">clear</i></span></button></div>';

        $('#alert-select-warning').html(alert_html);
    }
});