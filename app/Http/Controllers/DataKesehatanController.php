<?php

namespace App\Http\Controllers;

use App\Models\DataIbuHamil;
use Illuminate\Http\Request;
use App\Models\DataKesehatan;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

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
        $search = $request->input('search');

        $perPage = $request->input('per_page', 5);

        $data_kesehatans = DataKesehatan::with('ibuHamil')
            ->whereHas('ibuHamil', function ($query) use ($search) {
                $query->where('id_ibu', 'like', "%$search%");
            })
            ->paginate($perPage);

        $currentPage = $data_kesehatans->currentPage();

        return view('data-kesehatan', compact('data_kesehatans', 'currentPage', 'perPage'));
    }

    public function create()
    {
        $data_ibu_hamils = DataIbuHamil::all();

        return view('create-data-kesehatan', compact('data_ibu_hamils'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'tanggal' => 'required',
                'id_ibu' => 'required',
                'keluhan' => 'required',
                'tekanan_darah' => 'required|integer',
                'berat_badan' => 'required|integer',
                'umur_kehamilan' => 'required',
                'tinggi_fundus' => 'required|integer',
                'letak_janin' => 'required',
                'denyut_jantung_janin' => 'required|integer',
                'hasil_lab' => 'required',
                'tindakan' => 'required',
                'kaki_bengkak' => 'required',
                'nasihat' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal wajib diisi.',
                'id_ibu.required' => 'Nama Ibu wajib diisi.',
                'keluhan.required' => 'Keluhan wajib diisi.',
                'tekanan_darah.required' => 'Tekanan darah wajib diisi.',
                'tekanan_darah.integer' => 'Tekanan darah harus berupa angka.',
                'berat_badan.required' => 'Berat badan wajib diisi.',
                'berat_badan.integer' => 'Berat badan harus berupa angka.',
                'umur_kehamilan.required' => 'Umur kehamilan wajib diisi.',
                'tinggi_fundus.required' => 'Tinggi fundus wajib diisi.',
                'tinggi_fundus.integer' => 'Tinggi fundus harus berupa angka.',
                'letak_janin.required' => 'Letak janin wajib diisi.',
                'denyut_jantung_janin.required' => 'Denyut jantung janin wajib diisi.',
                'denyut_jantung_janin.integer' => 'Denyut jantung janin harus berupa angka.',
                'hasil_lab.required' => 'Hasil lab wajib diisi.',
                'tindakan.required' => 'Tindakan wajib diisi.',
                'kaki_bengkak.required' => 'Kaki bengkak wajib diisi.',
                'nasihat.required' => 'Nasihat wajib diisi.',
            ],
        );

        DataKesehatan::create($request->all());
        toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->route('data-kesehatan.index');
    }

    public function edit($id)
    {
        $data_ibu_hamils = DataIbuHamil::all();
        $data_kesehatans = DataKesehatan::find($id);
        return view('edit-data-kesehatan', compact('data_kesehatans', 'data_ibu_hamils'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'tanggal' => 'required',
                'id_ibu' => 'required',
                'keluhan' => 'required',
                'tekanan_darah' => 'required|integer',
                'berat_badan' => 'required|integer',
                'umur_kehamilan' => 'required',
                'tinggi_fundus' => 'required|integer',
                'letak_janin' => 'required',
                'denyut_jantung_janin' => 'required|integer',
                'hasil_lab' => 'required',
                'tindakan' => 'required',
                'kaki_bengkak' => 'required',
                'nasihat' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal wajib diisi.',
                'id_ibu.required' => 'Nama Ibu wajib diisi.',
                'keluhan.required' => 'Keluhan wajib diisi.',
                'tekanan_darah.required' => 'Tekanan darah wajib diisi.',
                'tekanan_darah.integer' => 'Tekanan darah harus berupa angka.',
                'berat_badan.required' => 'Berat badan wajib diisi.',
                'berat_badan.integer' => 'Berat badan harus berupa angka.',
                'umur_kehamilan.required' => 'Umur kehamilan wajib diisi.',
                'tinggi_fundus.required' => 'Tinggi fundus wajib diisi.',
                'tinggi_fundus.integer' => 'Tinggi fundus harus berupa angka.',
                'letak_janin.required' => 'Letak janin wajib diisi.',
                'denyut_jantung_janin.required' => 'Denyut jantung janin wajib diisi.',
                'denyut_jantung_janin.integer' => 'Denyut jantung janin harus berupa angka.',
                'hasil_lab.required' => 'Hasil lab wajib diisi.',
                'tindakan.required' => 'Tindakan wajib diisi.',
                'kaki_bengkak.required' => 'Kaki bengkak wajib diisi.',
                'nasihat.required' => 'Nasihat wajib diisi.',
            ],
        );

        $data_kesehatans = DataKesehatan::find($id);
        $data_kesehatans->tanggal = $request->tanggal;
        $data_kesehatans->id_ibu = $request->id_ibu;
        $data_kesehatans->keluhan = $request->keluhan;
        $data_kesehatans->tekanan_darah = $request->tekanan_darah;
        $data_kesehatans->berat_badan = $request->berat_badan;
        $data_kesehatans->umur_kehamilan = $request->umur_kehamilan;
        $data_kesehatans->tinggi_fundus = $request->tinggi_fundus;
        $data_kesehatans->letak_janin = $request->letak_janin;
        $data_kesehatans->denyut_jantung_janin = $request->denyut_jantung_janin;
        $data_kesehatans->hasil_lab = $request->hasil_lab;
        $data_kesehatans->tindakan = $request->tindakan;
        $data_kesehatans->kaki_bengkak = $request->kaki_bengkak;
        $data_kesehatans->nasihat = $request->nasihat;
        $data_kesehatans->save();

        toast('Data Berhasil Diubah', 'success');
        return redirect()->route('data-kesehatan.index');
    }

    public function delete($id)
    {
        $data_kesehatans = DataKesehatan::find($id);
        $data_kesehatans->delete();
        toast('Data Berhasil Dihapus', 'success');
        return redirect(route('data-kesehatan.index'));
    }

    public function download()
    {
        $data_kesehatans = DataKesehatan::with('ibuHamil')->get();

        $csvData = $this->generateCSV($data_kesehatans);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_kesehatan_mibu.csv',
        ];

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Kesehatan - MIBU \n \n";

        $csv .= "No,Tanggal Periksa,Nama Ibu,Keluhan,Tekanan Darah,Berat Badan,Umur Kehamilan,Tinggi Fundus,Letak Janin,Denyut Jantung Janin,Hasil Lab,Tindakan,Kaki Bengkak,Nasihat\n";

        $counter = 1;

        foreach ($data as $row) {
            $tekanan_darah = $row->tekanan_darah . ' mmHg';
            $berat_badan = $row->berat_badan . ' Kg';
            $tinggi_fundus = $row->tinggi_fundus . ' Cm';
            $denyut_jantung_janin = $row->denyut_jantung_janin . ' BPM';
            $id_ibu = $row->ibuHamil ? $row->ibuHamil->nama_ibu : 'Nama Tidak Ditemukan';

            $csv .= "{$counter},{$row->tanggal},{$id_ibu},{$row->keluhan},{$tekanan_darah},{$berat_badan},{$row->umur_kehamilan},{$tinggi_fundus},{$row->letak_janin},{$denyut_jantung_janin},{$row->hasil_lab},{$row->tindakan},{$row->kaki_bengkak},{$row->nasihat}\n";

            $counter++;
        }

        return $csv;
    }
}
