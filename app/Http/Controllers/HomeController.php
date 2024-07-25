<?php

namespace App\Http\Controllers;

use App\Models\DataIbuHamil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
        $data_ibu_hamils = DataIbuHamil::where('nama_ibu', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_ibu_hamils->currentPage();
        return view('home', compact('data_ibu_hamils', 'currentPage'));
    }

    public function create()
    {
        return view('create-data-ibu-hamil');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ibu'       => 'required',
            'umur_ibu'       => 'required|integer',
            'alamat'         => 'required',
            'email'          => 'required|email',
            'nik'            => 'required|numeric',
            'no_telepon'     => 'required|numeric',
            'kehamilan_ke'   => 'required|integer',
            'nama_suami'     => 'required',
            'umur_suami'     => 'required|integer',
            'password'       => 'required|min:8',
            'no_jkn_faskes_tk_1' => 'required',
            'no_jkn_rujukan' => 'required',
            'gol_darah' => 'required',
            'pekerjaan' => 'required',
        ], [
            'nama_ibu.required'     => 'Nama Ibu wajib diisi.',
            'umur_ibu.required'     => 'Umur Ibu wajib diisi.',
            'umur_ibu.integer'      => 'Umur Ibu harus berupa angka.',
            'alamat.required'       => 'Alamat wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Alamat email tidak valid, gunakan format email yang benar.',
            'nik.required'          => 'NIK wajib diisi.',
            'nik.numeric'           => 'NIK harus berupa angka.',
            'no_telepon.required'   => 'Nomor Telepon wajib diisi.',
            'no_telepon.numeric'    => 'Nomor Telepon harus berupa angka.',
            'kehamilan_ke.required' => 'Kehamilan Ke Berapa wajib diisi.',
            'kehamilan_ke.integer'  => 'Kehamilan Ke Berapa harus berupa angka.',
            'nama_suami.required'   => 'Nama Suami wajib diisi.',
            'umur_suami.required'   => 'Umur Suami wajib diisi.',
            'umur_suami.integer'    => 'Umur Suami harus berupa angka.',
            'password.required'     => 'Password harus diisi',
            'password.min'          => 'Password harus terdiri dari minimal 8 karakter.',
            'no_jkn_faskes_tk_1.required' => 'required',
            'no_jkn_rujukan.required' => 'required',
            'gol_darah.required' => 'required',
            'pekerjaan.required' => 'required',
        ]);
        
        DataIbuHamil::create($request->all());
        toast('Data Berhasil Ditambahkan','success');
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $data_ibu_hamils = DataIbuHamil::find($id);
        return view('edit-data-ibu-hamil', compact('data_ibu_hamils'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ibu'       => 'required',
            'umur_ibu'       => 'required|integer',
            'alamat'         => 'required',
            'email'          => 'required|email',
            'nik'            => 'required|numeric',
            'no_telepon'     => 'required|numeric',
            'kehamilan_ke'   => 'required|integer',
            'nama_suami'     => 'required',
            'umur_suami'     => 'required|integer',
            'no_jkn_faskes_tk_1' => 'required',
            'no_jkn_rujukan' => 'required',
            'gol_darah' => 'required',
            'pekerjaan' => 'required',
        ], [
            'nama_ibu.required'     => 'Nama Ibu wajib diisi.',
            'umur_ibu.required'     => 'Umur Ibu wajib diisi.',
            'umur_ibu.integer'      => 'Umur Ibu harus berupa angka.',
            'alamat.required'       => 'Alamat wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Alamat email tidak valid, gunakan format email yang benar.',
            'nik.required'          => 'NIK wajib diisi.',
            'nik.numeric'           => 'NIK harus berupa angka.',
            'no_telepon.required'   => 'Nomor Telepon wajib diisi.',
            'no_telepon.numeric'    => 'Nomor Telepon harus berupa angka.',
            'kehamilan_ke.required' => 'Kehamilan Ke Berapa wajib diisi.',
            'kehamilan_ke.integer'  => 'Kehamilan Ke Berapa harus berupa angka.',
            'nama_suami.required'   => 'Nama Suami wajib diisi.',
            'umur_suami.required'   => 'Umur Suami wajib diisi.',
            'umur_suami.integer'    => 'Umur Suami harus berupa angka.',
            'no_jkn_faskes_tk_1.required' => 'required',
            'no_jkn_rujukan.required' => 'required',
            'gol_darah.required' => 'required',
            'pekerjaan.required' => 'required',
        ]);
        
        $data_ibu_hamils               = DataIbuHamil::find($id);
        $data_ibu_hamils->nama_ibu     = $request->nama_ibu;
        $data_ibu_hamils->umur_ibu     = $request->umur_ibu;
        $data_ibu_hamils->alamat       = $request->alamat;
        $data_ibu_hamils->email        = $request->email;
        $data_ibu_hamils->nik          = $request->nik;
        $data_ibu_hamils->no_telepon   = $request->no_telepon;
        $data_ibu_hamils->kehamilan_ke = $request->kehamilan_ke;
        $data_ibu_hamils->nama_suami   = $request->nama_suami;
        $data_ibu_hamils->umur_suami   = $request->umur_suami;
        $data_ibu_hamils->no_jkn_faskes_tk_1   = $request->no_jkn_faskes_tk_1;
        $data_ibu_hamils->no_jkn_rujukan   = $request->no_jkn_rujukan;
        $data_ibu_hamils->gol_darah   = $request->gol_darah;
        $data_ibu_hamils->pekerjaan   = $request->pekerjaan;
        $data_ibu_hamils->tanggal_hpl   = $request->tanggal_hpl;
        $data_ibu_hamils->save();

        toast('Data Berhasil Diubah','success');
        return redirect()->route('home');
    }

    public function delete($id)
    {
        $data_ibu_hamils = DataIbuHamil::find($id);
        $data_ibu_hamils->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect(route('home'));
    }

    public function download()
    {
        $data_ibu_hamils = DataIbuHamil::all();

        $csvData = $this->generateCSV($data_ibu_hamils);

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_ibu_hamil_mibu.csv',
        );

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Ibu Hamil - MIBU \n \n";

        $csv .= "No,Nama Ibu,Umur Ibu,Alamat,Email,NIK,Nomor Telepon,Kehamilan Ke,Nama Suami,Umur Suami,No JKN Faskes TK 1,No JKN Rujukan,Gol Darah,Pekerjaan\n";

        $counter = 1;

        foreach ($data as $row) {
            $umur_ibu             = $row->umur_ibu . " Tahun";
            $umur_suami           = $row->umur_suami . " Tahun";

            $csv .= "{$counter},{$row->nama_ibu},{$umur_ibu},{$row->alamat},{$row->email},{$row->email},{$row->no_telepon},{$row->kehamilan_ke},{$row->nama_suami},{$umur_suami},{$row->no_jkn_faskes_tk_1},{$row->no_jkn_rujukan},{$row->gol_darah},{$row->pekerjaan}\n";
            
            $counter++;
        }

        return $csv;
    }
    
    public function uploadHpl(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:data_ibu_hamils,id',
            'tanggal_hpl' => 'required|date',
        ]);

        $id = $request->input('id');
        $tanggalHpl = $request->input('tanggal_hpl');

        $dataIbuHamil = DataIbuHamil::find($id);
        $dataIbuHamil->tanggal_hpl = $tanggalHpl;
        $dataIbuHamil->save();

        toast('Tanggal HPL Berhasil Diupload', 'success');
        return redirect()->route('home');
    }


}
