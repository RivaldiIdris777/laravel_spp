<?php

namespace App\Http\Controllers;

use App\Models\Tagihan as Model;
use App\Models\Siswa;
use App\Models\Biaya;
use App\Models\TagihanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;

class TagihanController extends Controller
{
    private $viewIndex = 'tagihan_index';
    private $viewCreate = 'tagihan_form';
    private $viewEdit = 'tagihan_form';
    private $viewShow = 'tagihan_show';
    private $routePrefix = 'tagihan';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $models = Model::latest()
            ->whereMonth('tanggal_tagihan', $request->bulan)
            ->whereYear('tanggal_tagihan', $request->tahun)
            ->paginate(50);
        }else {
            $models = Model::latest()->paginate(50);        
        }
        return view('operator.' . $this->viewIndex , [
            'models' => $models,            
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Tagihan'
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
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA TAGIHAN', 
            'angkatan' => Siswa::all()->pluck('angkatan', 'angkatan'),
            'kelas' => Siswa::pluck('kelas','kelas'),
            'biaya' => Biaya::get(),
            
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagihanRequest $request)
    {                                                        
        $requestData = $request->validated();
        //2. Ambil data biaya yang di tagihkan
        $biayaIdArray = $requestData['biaya_id'];
        
        //3. Ambil data siswa yang ditagih berdasarkan kelas ataau berdasarkan angkatan
        $siswa = Siswa::query();
        if ($requestData['kelas'] != '') {
            $siswa->where('kelas', $requestData['kelas']);
        }
        if ($requestData['angkatan'] != '') {
            $siswa->where('angkatan', $requestData['angkatan']);
        }
        $siswa = $siswa->get();
        //4. Lakukan perulangan berdasarkan data siswa
        foreach($siswa as $itemSiswa) {            
            $biaya = Biaya::whereIn('id', $biayaIdArray)->get();            
            unset($requestData['biaya_id']);
            //5. didalam perulangan, simpan tagihan berdasarkan biaya dan siswa
            $requestData['siswa_id'] = $itemSiswa->id;                        
            $requestData['status'] = 'baru';            
            $tanggalTagihan = Carbon::parse($requestData['tanggal_tagihan']);
            $bulanTagihan = $tanggalTagihan->format('m');
            $tahunTagihan = $tanggalTagihan->format('Y');
            $cekTagihan = Model::where('siswa_id', $itemSiswa->id)->whereMonth('tanggal_tagihan', $bulanTagihan)->whereYear('tanggal_tagihan', $tahunTagihan)->first();
            if ($cekTagihan == null) {
                $tagihan = Model::create($requestData);
                foreach($biaya as $itemBiaya) {                
                    $detail = TagihanDetail::create([
                        'tagihan_id' => $tagihan->id,
                        'nama_biaya' => $itemBiaya->nama,
                        'jumlah_biaya' => $itemBiaya->jumlah,
                    ]);
                }
            }
        }
        //6. simpan notifikasi untuk tagihan
        flash('Tagihan berhasil disimpan')->success();
        return back();
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tagihan = Model::with('siswa','tagihanDetails','user')->findOrFail($id);
        $data['tagihan'] = $tagihan;
        $data['siswa'] = $tagihan->siswa;
        $data['periode'] = Carbon::parse($tagihan->first()->tanggal_tagihan)->translatedFormat('F Y');
        return view('operator.' . $this->viewShow, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Model $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagihanRequest $request, Model $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $tagihan)
    {
        //
    }
}
