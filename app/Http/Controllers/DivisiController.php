<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Models\Pegawai as MainModel;

class DivisiController extends Controller
{
	public $fieldTable = ['id', 'nama'];
	public $fieldInput = ['nama' => 'required|max:30'];
	public $mainView = 'divisi';
	public $mainUrl = 'divisi';
    public function index(){
		return view($this->mainView);
	}

	public function store(Request $request) {
	    $validator = Validator::make($request->all(), $this->fieldInput);

	    if ($validator->fails()) {
	        return redirect('/')
	            ->withInput()
	            ->withErrors($validator);
	    }
	    $newRecord = new MainModel;
	    foreach ($this->fieldInput as $key => $value) {
	    	$newRecord->$key = $request->$key;

	    }
	    $newRecord->save();

	    return json_encode(['status' => true]);
	}

	public function getData(Request $request){
		$dataTempAll = MainModel::skip($request->start)->take($request->length)->get();
		$dataTempAll = MainModel::query();
		if($request->search['value']){
			foreach($this->fieldTable as $field){
			    $dataTempAll->orWhere($field, 'LIKE', '%'.$request->search['value'].'%');
			}
		}
		$dataTempAll = $dataTempAll->skip($request->start)->take($request->length)->get();
		$dataCount = MainModel::all()->count();
		$data = [];
		foreach ($dataTempAll as $dataTemp) {
			# code...
			$row = [];
			foreach ($this->fieldTable as $key => $value) {
				# code...
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
		return json_encode($record);
	}

	public function update(Request $request){
		$record = MainModel::find($request->id);
	    foreach ($this->fieldInput as $key => $value) {
	    	$record->$key = $request->$key;
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
