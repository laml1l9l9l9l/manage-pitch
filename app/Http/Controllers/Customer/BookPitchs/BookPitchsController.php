<?php

namespace App\Http\Controllers\Customer\BookPitchs;

use App\Http\Controllers\Controller;
use App\Model\Customer\Pitch;
use App\Model\Customer\Time;
use Illuminate\Http\Request;
use Validator;

class BookPitchsController extends Controller
{
    public function __construct(Pitch $pitch, Time $time)
    {
		$this->pitch = $pitch;
		$this->time  = $time;
    }

    public function check()
    {
    	return view('User.Customer.BookPitchs.check');
    }

    public function selectDateTimeRent(Request $request)
    {
    	$book_request = $request->book;
        $this->validatorSelectDateTimeRent($book_request)->validate();
    	dd($book_request);

    	$date_time_booking = $this->dateTimeBooking($book_request);
    	return view('User.Customer.BookPitchs.book', [
    		'date_time_booking' => $date_time_booking
    	]);
    }

    protected function dateTimeBooking(array date)
    {
    	# return array [
    	# 	{
    	# 		date: 2020-07-12,
    	# 		time: [ 1, 2, 4 ] // id time slot
    	# 	},
    	# 	{
    	# 		date: 2020-07-13,
    	# 		time: [ 2, 3, 4 ] // id time slot
    	# 	}
    	# ]
    	return null;
    }

    private $array_select_date_time_validate = [
        'time_start' => ['required', 'date_format:H:i'],
        'time_end'   => ['required', 'date_format:H:i', 'after_or_equal:time_start'],
        'date_start' => ['required', 'date_format:Y-m-d'],
        'date_end'   => ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'],
    ];


    private function validatorSelectDateTimeRent(array $data)
    {
        return Validator::make($data, $this->array_select_date_time_validate, $this->messages());
    }

    private function messages()
    {
        return [
            'required'                => 'Không được để trống',
            'date_format'             => 'Sai định dạng',
            'date_end.after_or_equal' => 'Ngày không hợp lệ',
            'time_end.after_or_equal' => 'Giờ không hợp lệ',
        ];
    }
}
