<?php

namespace App\Http\Controllers;

use App\Models\DataIbuHamil;
use App\Models\DataLayananKb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DataLayananKbController extends Controller
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
        $data_layanan_kbs = DataLayananKb::where('nama_ibu', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_layanan_kbs->currentPage();
        return view('data-layanan-kb', compact('data_layanan_kbs', 'currentPage'));
    }

    public function create()
    {
        $data_ibu_hamils = DataIbuHamil::all();

        return view('create-data-layanan-kb', compact('data_ibu_hamils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_praktik'      => 'required',
            'nama_ibu'             => 'required',
            'id_ibu'               => 'required|exists:data_ibu_hamils,id',
            'tekanan_darah'        => 'required|integer',
            'berat_badan'          => 'required|integer',
            'jenis_kb'             => 'required',
            'tanggal_kembali'      => 'required',
            'keluhan'              => 'required'
        ], [
            'tanggal_praktik.required'      => 'Tanggal wajib diisi.',
            'nama_ibu.required'             => 'Nama Ibu wajib diisi.',
            'tekanan_darah.required'        => 'Tekanan darah wajib diisi.',
            'tekanan_darah.integer'         => 'Tekanan darah harus berupa angka.',
            'berat_badan.required'          => 'Berat badan wajib diisi.',
            'berat_badan.integer'           => 'Berat badan harus berupa angka.',
            'jenis_kb.required'             => 'Pilih Jenis Kontrasepsi',
            'tanggal_kembali.required'      => 'Pilih tanggal kembali',
            'keluhan.required'              => 'Isi Keluhan Pasien'
        ]);

        // dd($request->all());
        $data = $request->all();
        $data['nama_ibu'] = DataIbuHamil::find($request->id_ibu)->nama_ibu;

        DataLayananKb::create($data);
        toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->route('data-layanan-kb.index');
    }

    public function edit($id)
    {
        $data_ibu_hamils = DataIbuHamil::all();
        $data_layanan_kbs = DataLayananKb::find($id);
        return view('edit-data-layanan-kb', compact('data_layanan_kbs', 'data_ibu_hamils'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_praktik'      => 'required',
            'nama_ibu'             => 'required',
            'id_ibu'               => 'required|exists:data_ibu_hamils,id',
            'tekanan_darah'        => 'required|integer',
            'berat_badan'          => 'required|integer',
            'jenis_kb'             => 'required',
            'tanggal_kembali'      => 'required',
            'keluhan'              => 'required'
        ], [
            'tanggal_praktik.required'      => 'Tanggal Praktik wajib diisi.',
            'nama_ibu.required'             => 'Nama Ibu wajib diisi.',
            'tekanan_darah.required'        => 'Tekanan darah wajib diisi.',
            'tekanan_darah.integer'         => 'Tekanan darah harus berupa angka.',
            'berat_badan.required'          => 'Berat badan wajib diisi.',
            'berat_badan.integer'           => 'Berat badan harus berupa angka.',
            'jenis_kb.required'             => 'Pilih Jenis KB',
            'tanggal_kembali'               => 'Pilih Tanggal Kembali',
            'keluhan.required'              => 'Isi Keluhan Pasien'
        ]);
        
        $data_layanan_kbs                       = DataLayananKb::find($id);
        $data_layanan_kbs->tanggal_praktik      = $request->tanggal_praktik;
        $data_layanan_kbs->nama_ibu             = $request->nama_ibu;
        $data_layanan_kbs->id_ibu               = $request->id_ibu;
        $data_layanan_kbs->tekanan_darah        = $request->tekanan_darah;
        $data_layanan_kbs->berat_badan          = $request->berat_badan;
        $data_layanan_kbs->jenis_kb             = $request->jenis_kb;
        $data_layanan_kbs->tanggal_kembali      = $request->tanggal_kembali;
        $data_layanan_kbs->keluhan              = $request->keluhan;
        $data_layanan_kbs->save();

        
        toast('Data Berhasil Diubah','success');
        return redirect()->route('data-layanan-kb.index');
    }

    public function delete($id)
    {
        $data_layanan_kbs = DataLayananKb::find($id);
        $data_layanan_kbs->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect(route('data-layanan-kb.index'));
    }

    public function download()
    {
        $data_layanan_kbs = DataLayananKb::all();

        $csvData = $this->generateCSV($data_layanan_kbs);

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_layanan_kb_mibu.csv',
        );

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Layanan KB - MIBU \n \n";

        $csv .= "No,Tanggal Praktik,Nama Ibu,Tekanan Darah,Berat Badan,Jenis KB,Tanggal Kembali,Keluhan\n";

        $counter = 1;

        foreach ($data as $row) {
            $tekanan_darah        = $row->tekanan_darah . " mmHg";
            $berat_badan          = $row->berat_badan . " Kg";
            $tanggal_praktik = \Carbon\Carbon::parse($row->tanggal_praktik)->format('Y/m/d');
            $tanggal_kembali = \Carbon\Carbon::parse($row->tanggal_kembali)->format('Y/m/d');

            $csv .= "{$counter},{$tanggal_praktik},{$row->nama_ibu},{$tekanan_darah},{$berat_badan},{$row->jenis_kb},{$tanggal_kembali},{$row->keluhan}\n";
            
            $counter++;
        }

        return $csv;
    }
}
