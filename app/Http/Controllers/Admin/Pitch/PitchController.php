<?php

namespace App\Http\Controllers\Admin\Pitch;

use App\Http\Controllers\Controller;
use App\Model\Admin\Pitch;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Validator;

class PitchController extends Controller
{
    public function __construct(Pitch $pitch)
    {
		$this->pitch = $pitch;
    }

    public function index(Request $request)
    {
		$model_pitch = $this->pitch;
		
		$offset      = 5;
		$start_page  = 1;
		$page        = $request->get('page');
		$page_pitch  = $this->indexTable($page, $offset);

        $pitch = $model_pitch->paginate($offset);
        $pitch->setPath(URL::current());

    	return view('User.Admin.Pitch.index',[
			'pitch'       => $pitch,
			'model_pitch' => $model_pitch,
			'page_pitch'  => $page_pitch
    	]);
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

		// save image
		Storage::disk('local')->put($imagePathFull, file_get_contents($image));

		$pitch = $this->pitch;
		$pitch->name       = $pitch_request['name'];
		$pitch->type       = $pitch_request['type'];
		$pitch->price      = $pitch_request['price'];
		$pitch->image      = $imagePathFull; //path image
		$pitch->created_at = Helper::getCurrentDateTime();
		$pitch->updated_at = Helper::getCurrentDateTime();
		$pitch->save();

        return redirect()->route('admin.pitch')
            ->with('success', 'Bạn đã thêm mới một sân bóng');
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

    private function messages()
    {
        return [
			'required' => 'Không được để trống',
			'string'   => 'Sai định dạng',
			'max'      => 'Sai định dạng, dài hơn :max ký tự',
			'min'      => 'Sai định dạng, ngắn hơn :min ký tự',
			'image'    => 'Phải chọn ảnh',
        ];
    }

}
