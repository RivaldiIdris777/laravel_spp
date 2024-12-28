<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;
use \App\Models\Siswa;

class WaliController extends Controller
{
    private $viewIndex = 'wali_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'wali_show';
    private $routePrefix = 'wali';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {                
        return view('operator.wali_index' , [
            'models' => Model::where('akses', 'wali')
            ->latest()
            ->paginate(50),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Wali'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => 'wali.store',
            'button' => 'SIMPAN',
            'title' => 'FORM WALI MURID'
            
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',            
            'password' => 'required'
        ]);

        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['akses'] = 'wali';
        Model::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Model::with('siswa')->wali()->where('id', $id)->firstOrFail();
        return view('operator.' . $this->viewShow, [
            'siswa' => Siswa::pluck('nama', 'id'),
            'model' => $model,
            'title' => 'DETAIL DATA WALI MURID'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'FORM DATA WALI MURID'
        ];
        return view('operator.' . $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'name' => 'required|unique:users,email,' . $id,
            'nohp' => 'required|unique:users,nohp,' . $id,            
            'password' => 'nullable'
        ]);
        $model = Model::findOrFail($id);
        if($requestData['password'] == "") {
            unset($requestData['password']);
        }else {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        $model->fill($requestData);
        $model->save();
        flash('Data berhasil diubah');
        return redirect()->route('wali.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Model::where('akses', 'wali')->firstOrFail();        
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
