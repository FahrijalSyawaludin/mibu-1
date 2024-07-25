<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use App\Models\DataIbuHamil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DataAnakController extends Controller
{
    public function index(Request $request)
    {
        $search      = $request->input('search');
        $perPage     = $request->input('per_page', 5);
        $data_anaks  = DataAnak::where('nama_ibu', 'like', "%$search%")->orWhere('nama_anak', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_anaks->currentPage();
        return view('data-anak', compact('data_anaks', 'currentPage'));
    }

    public function create()
    {
        $data_ibu_hamils = DataIbuHamil::all();
        return view('create-data-anak', compact('data_ibu_hamils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'           => 'required',
            'nama_ibu'          => 'required',
            'id_ibu'            => 'required|exists:data_ibu_hamils,id',
            'nama_anak'         => 'required',
            'tanggal_lahir'     => 'required',
            'umur'              => 'required',
            'berat_badan'       => 'required|integer',
            'tinggi_badan'      => 'required',
            'lingkar_kepala'    => 'required',
        ], [
            'tanggal.required'          => 'Tanggal Periksa wajib diisi.',
            'nama_ibu.required'         => 'Nama Ibu wajib diisi.',
            'nama_anak.required'        => 'Nama Anak wajib diisi.',
            'tanggal_lahir.required'    => 'Tanggal Lahir wajib diisi.',
            'umur.required'             => 'Umur wajib diisi.',
            'berat_badan.required'      => 'Berat badan wajib diisi.',
            'berat_badan.integer'       => 'Berat badan harus berupa angka.',
            'tinggi_badan.required'     => 'Tinggi badan wajib diisi',
            'lingkar_kepala.required'   => 'Lingkar kepala wajib diisi',
        ]);

        $data = $request->all();
        $data['nama_ibu'] = DataIbuHamil::find($request->id_ibu)->nama_ibu;
        

        DataAnak::create($data);
        toast('Data Berhasil Ditambahkan','success');
        return redirect()->route('data-anak.index');
    }

    public function edit($id)
    {
        $data_ibu_hamils = DataIbuHamil::all();
        $data_anaks = DataAnak::find($id);
        return view('edit-data-anak', compact('data_anaks', 'data_ibu_hamils'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'       => 'required',
            'nama_ibu'      => 'required',
            'id_ibu'        => 'required|exists:data_ibu_hamils,id',
            'nama_anak'     => 'required',
            'tanggal_lahir' => 'required',
            'umur'          => 'required',
            'berat_badan'   => 'required|integer',
            'tinggi_badan'      => 'required',
            'lingkar_kepala'    => 'required',
        ], [
            'tanggal.required'       => 'Tanggal Periksa wajib diisi.',
            'nama_ibu.required'      => 'Nama Ibu wajib diisi.',
            'nama_anak.required'     => 'Nama Anak wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'umur.required'          => 'Umur wajib diisi.',
            'berat_badan.required'   => 'Berat badan wajib diisi.',
            'berat_badan.integer'    => 'Berat badan harus berupa angka.',
            'tinggi_badan.required'     => 'Tinggi badan wajib diisi',
            'lingkar_kepala.required'   => 'Lingkar kepala wajib diisi',
        ]);
        
        $data_anaks                = DataAnak::find($id);
        $data_anaks->tanggal       = $request->tanggal;
        $data_anaks->nama_ibu      = $request->nama_ibu;
        $data_anaks->id_ibu        = $request->id_ibu;
        $data_anaks->nama_anak     = $request->nama_anak;
        $data_anaks->tanggal_lahir = $request->tanggal_lahir;
        $data_anaks->umur          = $request->umur;
        $data_anaks->berat_badan   = $request->berat_badan;
        $data_anaks->tinggi_badan   = $request->tinggi_badan;
        $data_anaks->lingkar_kepala   = $request->lingkar_kepala;
        $data_anaks->save();

    

        toast('Data Berhasil Diubah','success');
        return redirect()->route('data-anak.index');
    }

    public function delete($id)
    {
        $data_anaks = DataAnak::find($id);
        $data_anaks->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect(route('data-anak.index'));
    }

    public function download()
    {
        $data_anaks = DataAnak::all();

        $csvData = $this->generateCSV($data_anaks);

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_anak_mibu.csv',
        );

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Anak - MIBU \n \n";

        $csv .= "No,Tanggal Periksa,Nama Ibu,Nama Anak,Tanggal Lahir,Umur,Berat Badan, Tinggi Badan, Lingkar Kepala\n";

        $counter = 1;

        foreach ($data as $row) {
            $berat_badan          = $row->berat_badan . " Kg";
            $tinggi_badan         = $row->tinggi_badan . " Cm";
            $lingkar_kepala         = $row->lingkar_kepala . " Cm";

            $csv .= "{$counter},{$row->tanggal},{$row->nama_ibu},{$row->nama_anak},{$row->tanggal_lahir},{$row->umur},{$berat_badan},{$tinggi_badan},{$lingkar_kepala}\n";
            
            $counter++;
        }

        return $csv;
    }

}
