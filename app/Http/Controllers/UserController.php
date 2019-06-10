<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\User as MainModel;
use App\Models\Divisi;
use App\Models\Jabatan;

use Illuminate\Hashing\BcryptHasher;

use App\Services\PegawaiService as MainService;

class UserController extends Controller
{
	public $fieldTable = ['id', 'name', 'email'];
	public $fieldInput = ['name' => 'required|max:30', 'email' => 'required', 'password' => 'required'];
	public $mainView = 'user';
	public $mainUrl = 'user';
	public $title = 'user';

    public function index(){
    	$user = \Auth::user();
		return view($this->mainView, ["mainUrl" => $this->mainUrl, "title" => $this->title]);
	}

	public function store(Request $request) {
	    $validator = Validator::make($request->all(), $this->fieldInput);

	    if ($validator->fails()) {
	    	return 0;
	    }
	    $newRecord = new MainModel;
	    foreach ($this->fieldInput as $key => $value) {
	    	$newRecord->$key = $request->$key;

	    }
	    $hasher = new BcryptHasher();
	    // $newRecord->password = $hasher->make($newRecord->password);
	    $newRecord->forceFill([
                'password' => bcrypt($newRecord->password),
               'remember_token' => Str::random(60),
            ])->save();
	    // $newRecord->save();

	    return json_encode(['status' => true]);
	}

	public function getData(Request $request){
		
		$dataTempAll = MainModel::init()->getData($request);
		$dataCount = MainModel::all()->count();
		$data = [];
		foreach ($dataTempAll as $dataTemp) {
			$row = [];
			foreach ($this->fieldTable as $key => $value) {
				$row[] = $dataTemp->$value;
			}
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$dataTemp->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$dataTemp->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}
		return json_encode(['status' => true, 'data' => $data, "recordsFiltered" => $dataCount]);
	}
	public function edit($id){
		$record = MainModel::where('id', $id)->first();
		$record->password = "";
		return json_encode($record);
	}

	public function update(Request $request){
		$validator = Validator::make($request->all(), $this->fieldInput);

	    if ($validator->fails()) {
	    	return 0;
	    }
		$record = MainModel::find($request->id);

    	$record->nama = $request->nama;
    	$record->email = $request->email;
    	if($request->password != ""){
    		$record->forceFill([
            	'password' => bcrypt($record->password),
            	'remember_token' => Str::random(60),
            ]);
    	}
	    $record->save();
	    return json_encode(['status' => true]);
	}

	public function delete($id){
		$record = MainModel::find($id);
	    $record->delete();
	    return json_encode(['status' => true]);
	}
}
