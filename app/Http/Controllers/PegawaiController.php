<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Models\Pegawai as MainModel;
use App\Models\Divisi;
use App\Models\Jabatan;

use App\Services\PegawaiService as MainService;

class PegawaiController extends Controller
{
	public $fieldTable = ['id', 'nama', 'divisi', 'telepon', 'alamat'];
	public $fieldInput = ['nama' => 'required|max:30', 'divisi' => 'required', 'jabatan' => 'required', 'telepon' => 'required', 'alamat' => 'required'];
	public $mainView = 'pegawai';
	public $mainUrl = 'pegawai';
	public $title = 'Pegawai';
    public function index(){
    	$divisiAll = Divisi::all();
    	$jabatanAll = Jabatan::all();
		return view($this->mainView, ["mainUrl" => $this->mainUrl, "title" => $this->title, "divisiAll" => $divisiAll, "jabatanAll" => $jabatanAll]);
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
