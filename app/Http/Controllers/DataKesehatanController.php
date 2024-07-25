<?php

namespace App\Http\Controllers;

use App\Models\DataIbuHamil;
use Illuminate\Http\Request;
use App\Models\DataKesehatan;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class DataKesehatanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search          = $request->input('search');
        $perPage         = $request->input('per_page', 5);
        $data_kesehatans = DataKesehatan::where('nama_ibu', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_kesehatans->currentPage();
        return view('data-kesehatan', compact('data_kesehatans', 'currentPage'));
    }

    public function create()
    {
        $data_ibu_hamils = DataIbuHamil::all();
        $data_pemeriksas = User::all();

        return view('create-data-kesehatan', compact('data_ibu_hamils', 'data_pemeriksas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'              => 'required',
            'nama_ibu'             => 'required',
            'id_ibu'               => 'required|exists:data_ibu_hamils,id',
            'id_pemeriksa'         => 'required|exists:users,id',
            'keluhan'              => 'required',
            'tekanan_darah'        => 'required|integer',
            'berat_badan'          => 'required|integer',
            'umur_kehamilan'       => 'required',
            'tinggi_fundus'        => 'required|integer',
            'letak_janin'          => 'required',
            'denyut_jantung_janin' => 'required|integer',
            'hasil_lab'            => 'required',
            'tindakan'             => 'required',
            'kaki_bengkak'         => 'required',
            'nasihat'              => 'required',
            'nama_pemeriksa'       => 'required',
            'tinggi_badan'         => 'required',
            'lingkar_perut'        => 'required',
            'lingkar_lengan_atas'  => 'required'
        ], [
            'tanggal.required'              => 'Tanggal wajib diisi.',
            'nama_ibu.required'             => 'Nama Ibu wajib diisi.',
            'keluhan.required'              => 'Keluhan wajib diisi.',
            'tekanan_darah.required'        => 'Tekanan darah wajib diisi.',
            'tekanan_darah.integer'         => 'Tekanan darah harus berupa angka.',
            'berat_badan.required'          => 'Berat badan wajib diisi.',
            'berat_badan.integer'           => 'Berat badan harus berupa angka.',
            'umur_kehamilan.required'       => 'Umur kehamilan wajib diisi.',
            'tinggi_fundus.required'        => 'Tinggi fundus wajib diisi.',
            'tinggi_fundus.integer'         => 'Tinggi fundus harus berupa angka.',
            'letak_janin.required'          => 'Letak janin wajib diisi.',
            'denyut_jantung_janin.required' => 'Denyut jantung janin wajib diisi.',
            'denyut_jantung_janin.integer'  => 'Denyut jantung janin harus berupa angka.',
            'hasil_lab.required'            => 'Hasil lab wajib diisi.',
            'tindakan.required'             => 'Tindakan wajib diisi.',
            'kaki_bengkak.required'         => 'Kaki bengkak wajib diisi.',
            'nasihat.required'              => 'Nasihat wajib diisi.',
            'nama_pemeriksa.required'       => 'Nama pemeriksa wajib diisi',
            'tinggi_badan'                  => 'Tinggi badan wajib diisi',
            'lingkar_perut'                 => 'Lingkar perut wajib diisi',
            'lingkar_lengan_atas'           => 'Lingkar lengan atas wajib diisi'
        ]);

        $data = $request->all();
        $data['nama_ibu'] = DataIbuHamil::find($request->id_ibu)->nama_ibu;
        $data['nama_pemeriksa'] = User::find($request->id_pemeriksa)->name;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->file('image')->extension();  
            $request->file('image')->move(public_path('foto_usg'), $imageName);
            $data['foto_usg'] = url('foto_usg/' . $imageName);
        }

        DataKesehatan::create($data);
        toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->route('data-kesehatan.index');
    }


    public function edit($id)
    {
        $data_ibu_hamils = DataIbuHamil::all();
        $data_kesehatans = DataKesehatan::find($id);
        $data_pemeriksas = User::all();
        return view('edit-data-kesehatan', compact('data_kesehatans', 'data_ibu_hamils', 'data_pemeriksas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'              => 'required',
            'nama_ibu'             => 'required',
            'id_ibu'               => 'required|exists:data_ibu_hamils,id',
            'id_pemeriksa'         => 'required|exists:users,id',
            'keluhan'              => 'required',
            'tekanan_darah'        => 'required|integer',
            'berat_badan'          => 'required|integer',
            'umur_kehamilan'       => 'required',
            'tinggi_fundus'        => 'required|integer',
            'letak_janin'          => 'required',
            'denyut_jantung_janin' => 'required|integer',
            'hasil_lab'            => 'required',
            'tindakan'             => 'required',
            'kaki_bengkak'         => 'required',
            'nasihat'              => 'required',
            'nama_pemeriksa'       => 'required',
            'tinggi_badan'         => 'required',
            'lingkar_perut'        => 'required',
            'lingkar_lengan_atas'  => 'required'
        ], [
            'tanggal.required'              => 'Tanggal wajib diisi.',
            'nama_ibu.required'             => 'Nama Ibu wajib diisi.',
            'keluhan.required'              => 'Keluhan wajib diisi.',
            'tekanan_darah.required'        => 'Tekanan darah wajib diisi.',
            'tekanan_darah.integer'         => 'Tekanan darah harus berupa angka.',
            'berat_badan.required'          => 'Berat badan wajib diisi.',
            'berat_badan.integer'           => 'Berat badan harus berupa angka.',
            'umur_kehamilan.required'       => 'Umur kehamilan wajib diisi.',
            'tinggi_fundus.required'        => 'Tinggi fundus wajib diisi.',
            'tinggi_fundus.integer'         => 'Tinggi fundus harus berupa angka.',
            'letak_janin.required'          => 'Letak janin wajib diisi.',
            'denyut_jantung_janin.required' => 'Denyut jantung janin wajib diisi.',
            'denyut_jantung_janin.integer'  => 'Denyut jantung janin harus berupa angka.',
            'hasil_lab.required'            => 'Hasil lab wajib diisi.',
            'tindakan.required'             => 'Tindakan wajib diisi.',
            'kaki_bengkak.required'         => 'Kaki bengkak wajib diisi.',
            'nasihat.required'              => 'Nasihat wajib diisi.',
            'nama_pemeriksa.required'       => 'Nama pemeriksa wajib diisi',
            'tinggi_badan'                  => 'Tinggi badan wajib diisi',
            'lingkar_perut'                 => 'Lingkar perut wajib diisi',
            'lingkar_lengan_atas'           => 'Lingkar lengan atas wajib diisi'
            
        ]);
        
        $data_kesehatans                       = DataKesehatan::find($id);
        $data_kesehatans->tanggal              = $request->tanggal;
        $data_kesehatans->nama_ibu             = $request->nama_ibu;
        $data_kesehatans->id_ibu               = $request->id_ibu;
        $data_kesehatans->keluhan              = $request->keluhan;
        $data_kesehatans->tekanan_darah        = $request->tekanan_darah;
        $data_kesehatans->berat_badan          = $request->berat_badan;
        $data_kesehatans->umur_kehamilan       = $request->umur_kehamilan;
        $data_kesehatans->tinggi_fundus        = $request->tinggi_fundus;
        $data_kesehatans->letak_janin          = $request->letak_janin;
        $data_kesehatans->denyut_jantung_janin = $request->denyut_jantung_janin;
        $data_kesehatans->hasil_lab            = $request->hasil_lab;
        $data_kesehatans->tindakan             = $request->tindakan;
        $data_kesehatans->kaki_bengkak         = $request->kaki_bengkak;
        $data_kesehatans->nasihat              = $request->nasihat;
        $data_kesehatans->nama_pemeriksa       = $request->nama_pemeriksa;
        $data_kesehatans->id_pemeriksa         = $request->id_pemeriksa;
        $data_kesehatans->tanggal_hpl          = $request->tanggal_hpl;
        $data_kesehatans->tinggi_badan          = $request->tinggi_badan;
        $data_kesehatans->lingkar_perut          = $request->lingkar_perut;
        $data_kesehatans->lingkar_lengan_atas          = $request->lingkar_lengan_atas;
        $data_kesehatans->save();

        toast('Data Berhasil Diubah','success');
        return redirect()->route('data-kesehatan.index');
    }

    public function delete($id)
    {
        $data_kesehatans = DataKesehatan::find($id);
        $data_kesehatans->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect(route('data-kesehatan.index'));
    }

    public function download()
    {
        $data_kesehatans = DataKesehatan::all();

        $csvData = $this->generateCSV($data_kesehatans);

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_kesehatan_mibu.csv',
        );

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Kesehatan - MIBU \n \n";

        $csv .= "No,Tanggal Periksa,Nama Pemeriksa,Nama Ibu,Keluhan,Tekanan Darah,Berat Badan,Umur Kehamilan,Tinggi Fundus,Letak Janin,Denyut Jantung Janin,Hasil Lab,Tindakan,Kaki Bengkak,Nasihat, Tinggi Badan, Lingkar Perut, Lingkar Lengan Atas\n";

        $counter = 1;

        foreach ($data as $row) {
            $tekanan_darah        = $row->tekanan_darah . " mmHg";
            $berat_badan          = $row->berat_badan . " Kg";
            $tinggi_fundus        = $row->tinggi_fundus . " Cm";
            $denyut_jantung_janin = $row->denyut_jantung_janin . " BPM";

            $csv .= "{$counter},{$row->tanggal},
            {$row->nama_pemeriksa},{$row->nama_ibu},
            {$row->keluhan},{$tekanan_darah},{$berat_badan},
            {$row->umur_kehamilan},{$tinggi_fundus},{$row->letak_janin},
            {$denyut_jantung_janin},{$row->hasil_lab},{$row->tindakan},
            {$row->kaki_bengkak},{$row->nasihat},{$row->tinggi_badan},{$row->lingkar_perut},{$row->lingkar_lengan_atas}\n";
            
            $counter++;
        }

        return $csv;
    }

    public function viewFotoUsg($id)
    {
        $dataKesehatan = DataKesehatan::find($id);

        if ($dataKesehatan && $dataKesehatan->foto_usg) {
            // Extract the file name from the URL
            $fileName = basename(parse_url($dataKesehatan->foto_usg, PHP_URL_PATH));
            $filePath = public_path('foto_usg/' . $fileName);
            
            if (File::exists($filePath)) {
                return response()->file($filePath);
            } else {
                return redirect()->back()->with('error', 'Foto USG tidak ditemukan.');
            }
        }

        return redirect()->back()->with('error', 'Data kesehatan tidak ditemukan.');
    }




}
