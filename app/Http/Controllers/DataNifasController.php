<?php

namespace App\Http\Controllers;

use App\Models\DataNifas;
use App\Models\DataIbuHamil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DataNifasController extends Controller
{
    public function index(Request $request)
    {
        $search      = $request->input('search');
        $perPage     = $request->input('per_page', 5);
        $data_nifas  = DataNifas::where('nama_ibu', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_nifas->currentPage();
        return view('data-nifas', compact('data_nifas', 'currentPage'));
    }

    public function create()
    {
        $data_ibu_hamils = DataIbuHamil::all();
        return view('create-data-nifas', compact('data_ibu_hamils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'                   => 'required',
            'nama_ibu'                  => 'required',
            'id_ibu'                    => 'required|exists:data_ibu_hamils,id',
            'kunjungan_nifas'           => 'required',
            'hasil_periksa_payudara'    => 'required',
            'hasil_periksa_pendarahan'  => 'required',
            'hasil_periksa_jalan_lahir' => 'required',
            'vitamin_a'                 => 'required',
            'masalah'                   => 'required',
            'tindakan'                  => 'required',
        ], [
            'tanggal.required'                   => 'Tanggal wajib diisi.',
            'nama_ibu.required'                  => 'Nama Ibu wajib diisi.',
            'kunjungan_nifas.required'           => 'Kunjungan Nifas wajib diisi.',
            'hasil_periksa_payudara.required'    => 'Hasil Periksa Payudara wajib diisi.',
            'hasil_periksa_pendarahan.required'  => 'Hasil Periksa Pendarahan wajib diisi.',
            'hasil_periksa_jalan_lahir.required' => 'Hasil Periksa Jalan Lahir wajib diisi.',
            'vitamin_a.required'                 => 'Vitamin A wajib diisi.',
            'masalah.required'                   => 'Masalah wajib diisi.',
            'tindakan.required'                  => 'Tindakan wajib diisi.',
        ]);

        $data = $request->all();
        $data['nama_ibu'] = DataIbuHamil::find($request->id_ibu)->nama_ibu;
        

        DataNifas::create($data);
        toast('Data Berhasil Ditambahkan','success');
        return redirect()->route('data-nifas.index');
    }

    public function edit($id)
    {
        $data_ibu_hamils = DataIbuHamil::all();
        $data_nifas = DataNifas::find($id);
        return view('edit-data-nifas', compact('data_nifas', 'data_ibu_hamils'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'                   => 'required',
            'nama_ibu'                  => 'required',
            'id_ibu'                    => 'required|exists:data_ibu_hamils,id',
            'kunjungan_nifas'           => 'required',
            'hasil_periksa_payudara'    => 'required',
            'hasil_periksa_pendarahan'  => 'required',
            'hasil_periksa_jalan_lahir' => 'required',
            'vitamin_a'                 => 'required',
            'masalah'                   => 'required',
            'tindakan'                  => 'required',
        ], [
            'tanggal.required'                   => 'Tanggal wajib diisi.',
            'nama_ibu.required'                  => 'Nama Ibu wajib diisi.',
            'kunjungan_nifas.required'           => 'Kunjungan Nifas wajib diisi.',
            'hasil_periksa_payudara.required'    => 'Hasil Periksa Payudara wajib diisi.',
            'hasil_periksa_pendarahan.required'  => 'Hasil Periksa Pendarahan wajib diisi.',
            'hasil_periksa_jalan_lahir.required' => 'Hasil Periksa Jalan Lahir wajib diisi.',
            'vitamin_a.required'                 => 'Vitamin A wajib diisi.',
            'masalah.required'                   => 'Masalah wajib diisi.',
            'tindakan.required'                  => 'Tindakan wajib diisi.',
        ]);
        
        $data_nifas                            = DataNifas::find($id);
        $data_nifas->tanggal                   = $request->tanggal;
        $data_nifas->nama_ibu                  = $request->nama_ibu;
        $data_nifas->id_ibu                  = $request->id_ibu;
        $data_nifas->kunjungan_nifas           = $request->kunjungan_nifas;
        $data_nifas->hasil_periksa_payudara    = $request->hasil_periksa_payudara;
        $data_nifas->hasil_periksa_pendarahan  = $request->hasil_periksa_pendarahan;
        $data_nifas->hasil_periksa_jalan_lahir = $request->hasil_periksa_jalan_lahir;
        $data_nifas->vitamin_a                 = $request->vitamin_a;
        $data_nifas->masalah                   = $request->masalah;
        $data_nifas->tindakan                  = $request->tindakan;
        $data_nifas->save();

        toast('Data Berhasil Diubah','success');
        return redirect()->route('data-nifas.index');
    }

    public function delete($id)
    {
        $data_nifas = DataNifas::find($id);
        $data_nifas->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect(route('data-nifas.index'));
    }

    public function download()
    {
        $data_nifas = DataNifas::all();

        $csvData = $this->generateCSV($data_nifas);

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_nifas_mibu.csv',
        );

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Nifas - MIBU \n \n";

        $csv .= "No,Tanggal Periksa,Nama Ibu,Kunjungan Nifas,Hasil Periksa Payudara,Hasil Periksa Pendarahan,Hasil Periksa Jalan Lahir,Vitamin A,Masalah,Tindakan\n";

        $counter = 1;

        foreach ($data as $row) {
            $csv .= "{$counter},{$row->tanggal},{$row->nama_ibu},{$row->kunjungan_nifas},{$row->hasil_periksa_payudara},{$row->hasil_periksa_pendarahan},{$row->hasil_periksa_jalan_lahir},{$row->vitamin_a},{$row->masalah},{$row->tindakan}\n";
            
            $counter++;
        }

        return $csv;
    }
}
