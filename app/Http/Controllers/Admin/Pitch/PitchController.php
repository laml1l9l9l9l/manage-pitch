<?php

namespace App\Http\Controllers\Admin\Pitch;

use App\Http\Controllers\Controller;
use App\Model\Admin\Pitch;
use App\Model\Admin\DetailBill;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Validator;

class PitchController extends Controller
{
    public function __construct(Pitch $pitch, DetailBill $detail_bill)
    {
        $this->pitch       = $pitch;
        $this->detail_bill = $detail_bill;
    }

    public function index(Request $request)
    {
		$request_pitch = $request->pitch;
		$format_data_request = !empty($request_pitch) ? $request_pitch : '';
		$model_pitch   = $this->pitch;
		
		$offset      = 5;
		$start_page  = 1;
		$page        = $request->get('page');
		$page_pitch  = $this->indexTable($page, $offset);

		// Format data
		!empty($format_data_request) ? $format_data_request['price_start'] = preg_replace('/[^0-9]/', '', $request_pitch['price_start']) : '';
		!empty($format_data_request) ? $format_data_request['price_end'] = preg_replace('/[^0-9]/', '', $request_pitch['price_end']) : '';

		$pitch = !empty($request_pitch) ? $this->search($format_data_request) : $model_pitch;
        $pitch = $pitch->paginate($offset);
        $pitch->setPath(URL::current());

    	return view('User.Admin.Pitch.index',[
            'pitch'         => $pitch,
            'model_pitch'   => $model_pitch,
            'page_pitch'    => $page_pitch,
            'request_pitch' => $request_pitch,
            'request'       => $request->all()
    	]);
    }

    public function search($request_pitch)
    {
        $pitch = $this->pitch;

        !empty($request_pitch['name']) ? $pitch = $pitch->where('name', 'like', '%'.$request_pitch['name'].'%') : '';
        !empty($request_pitch['price_start']) ? $pitch = $pitch->where('price', '>=', $request_pitch['price_start']) : '';
        !empty($request_pitch['price_end']) ? $pitch = $pitch->where('price', '<=', $request_pitch['price_end']) : '';
        (isset($request_pitch['type']) && $request_pitch['type'] !== null) ? $pitch = $pitch->where('type', $request_pitch['type']) : '';
        (isset($request_pitch['status']) && $request_pitch['status'] !== null) ? $pitch = $pitch->where('status', $request_pitch['status']) : '';
        !empty($request_pitch['start_created_at']) ? $pitch = $pitch->where('created_at', '>=', $request_pitch['start_created_at'].' 00:00:00') : '';
        !empty($request_pitch['end_created_at']) ? $pitch = $pitch->where('created_at', '<=', $request_pitch['end_created_at'].' 23:59:59') : '';

        return $pitch;
    }

    public function add()
    {
        $model_pitch = $this->pitch;
    	return view('User.Admin.Pitch.add', [
    		'model_pitch' => $model_pitch
    	]);
    }

    public function store(Request $request)
    {
    	// Get all information and file upload
		$pitch_request = $request->pitch;
		$pitch_request['price'] = preg_replace('/[^0-9]/', '', $pitch_request['price']);


        $this->validatorAddPitch($pitch_request)->validate();

        // Create path image
		$image      = $pitch_request['image'];
		$hashedName = hash_file('md5', $image->path());
		$imageName  = $hashedName . time() . '.' . $image->getClientOriginalExtension();
		$imagePath  = '/public/img/pitch';
		$imagePathFull = $imagePath . '/' . $imageName;

		// Save image
		Storage::disk('local')->put($imagePathFull, file_get_contents($image));

		$pitch = $this->pitch;
        $pitch->name       = $pitch_request['name'];
        $pitch->type       = $pitch_request['type'];
        $pitch->status     = ACTIVE;
        $pitch->price      = $pitch_request['price'];
        $pitch->image      = $imagePathFull; //path image
        $pitch->created_at = Helper::getCurrentDateTime();
        $pitch->updated_at = Helper::getCurrentDateTime();
		$pitch->save();

        return redirect()->route('admin.pitch')
            ->with('success', 'Bạn đã thêm mới một sân bóng');
    }

    public function edit($id)
    {
        $model_pitch = $this->pitch;

        $pitch      = $model_pitch->find($id);
        $path_image = str_replace('public', 'storage', $pitch->image);
        return view('User.Admin.Pitch.edit', [
            'pitch'       => $pitch,
            'model_pitch' => $model_pitch,
            'path_image'  => $path_image,
        ]);
    }

    public function update($id, Request $request)
    {
        $model_pitch = $this->pitch;
        $pitch_request = $request->pitch;
        $pitch_request['price'] = preg_replace('/[^0-9]/', '', $pitch_request['price']);


        $this->validatorEditPitch($pitch_request)->validate();

        // Get pitch
        $pitch = $model_pitch->find($id);

        // Check isset image
        if(!empty($pitch_request['image']))
        {
            // Create path image
            $image      = $pitch_request['image'];
            $hashedName = hash_file('md5', $image->path());
            $imageName  = $hashedName . time() . '.' . $image->getClientOriginalExtension();
            $imagePath  = '/public/img/pitch';
            $imagePathFull = $imagePath . '/' . $imageName;

            // Save new image and delete old image
            Storage::disk('local')->put($imagePathFull, file_get_contents($image));
            Storage::disk('local')->delete($pitch->image);
        }
        $pitch->name       = $pitch_request['name'];
        $pitch->type       = $pitch_request['type'];
        $pitch->status     = $pitch_request['status'];
        $pitch->price      = $pitch_request['price'];
        !empty($pitch_request['image']) ? $pitch->image = $imagePathFull : '';
        $pitch->updated_at = Helper::getCurrentDateTime();
        $pitch->save();

        return redirect()->route('admin.pitch.edit', ['id' => $id])
            ->with('success', 'Bạn đã sửa sân bóng');
    }

    public function delete($id)
    {
        $model_pitch       = $this->pitch;
        $model_detail_bill = $this->detail_bill;
        $isset_pitch = false;
        $name_route  = 'admin.pitch';

        $pitch = $model_pitch->find($id);

        // Check isset pitch in bill
        $detail_bill = $model_detail_bill->where('id_pitch', $id)
            ->first();
        $isset_pitch = !empty($detail_bill) ? true : false;
        if(!$isset_pitch)
        {
            Storage::disk('local')->delete($pitch->image);
            $pitch->delete();

            return redirect()->route($name_route)
                ->with('success', 'Bạn đã xóa sân bóng');
        }

        return redirect()->route($name_route)
            ->with('error', 'Sân bóng đã được đặt, không thể xóa');
    }


    private function validatorAddPitch(array $data)
    {
        return Validator::make($data, [
			'name'  => ['required', 'string', 'min:2', 'max:25'],
			'type'  => ['required', 'string', 'min:1', 'max:1'],
			'price' => ['required', 'string', 'min:5', 'max:7'],
			'image' => ['required', 'image'],
        ], $this->messages());
    }

    private function validatorEditPitch(array $data)
    {
        return Validator::make($data, [
            'name'   => ['required', 'string', 'min:2', 'max:25'],
            'type'   => ['required', 'string', 'min:1', 'max:1'],
            'status' => ['required', 'string', 'min:1', 'max:1'],
            'price'  => ['required', 'string', 'min:5', 'max:7'],
            'image'  => ['image'],
        ], $this->messages());
    }

    private function messages()
    {
        return [
			'required' => 'Không được để trống',
			'string'   => 'Sai định dạng',
			'max'      => 'Sai định dạng, dài hơn :max ký tự',
			'min'      => 'Sai định dạng, ngắn hơn :min ký tự',
			'type.max' => 'Sai định dạng',
			'type.min' => 'Sai định dạng',
			'image'    => 'Phải chọn ảnh',
        ];
    }

}
