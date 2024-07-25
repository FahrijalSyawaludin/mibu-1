<?php

namespace App\Http\Controllers;

use App\Models\DataArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class DataArtikelController extends Controller
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
        $data_artikels   = DataArtikel::where('judul', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_artikels->currentPage();
        return view('data-artikel', compact('data_artikels', 'currentPage'));
    }

    public function create()
    {
        $data_artikels = DataArtikel::all();

        return view('create-data-artikel', compact('data_artikels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'              => 'required',
            'judul'                => 'required',
            'isi'                  => 'required',
            'author'               => 'required',
        ], [
            'tanggal.required'              => 'Pilih tanggal',
            'judul.required'                => 'Isi Judul',
            'isi.required'                  => 'Masukkkan Isi artikel',
            'author.required'               => 'Masukkan nama author',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->file('image')->extension();  
            $request->file('image')->move(public_path('foto_artikel'), $imageName);
            $data['foto'] = url('foto_artikel/' . $imageName);
        }

        DataArtikel::create($data);
        toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->route('data-artikel.index');
    }


    public function edit($id)
    {
        $data_artikels = DataArtikel::find($id);

        return view('edit-data-artikel', compact('data_artikels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'              => 'required',
            'judul'                => 'required',
            'isi'                  => 'required',
            'author'               => 'required',
        ], [
            'tanggal.required'              => 'Pilih tanggal',
            'judul.required'                => 'Isi Judul',
            'isi.required'                  => 'Masukkkan Isi artikel',
            'author.required'               => 'Masukkan nama author',
            
        ]);
        
        $data_artikels                       = DataArtikel::find($id);
        $data_artikels->tanggal              = $request->tanggal;
        $data_artikels->judul                = $request->judul;
        $data_artikels->isi                  = $request->isi;
        $data_artikels->author               = $request->author;
        $data_artikels->save();

        toast('Data Berhasil Diubah','success');
        return redirect()->route('data-artikel.index');
    }

    public function delete($id)
    {
        $data_artikels = DataArtikel::find($id);
        $data_artikels->delete();
        toast('Data Berhasil Dihapus','success');
        return redirect(route('data-artikel.index'));
    }

    public function viewFotoArtikel($id)
    {
        $dataArtikel = DataArtikel::find($id);

        if ($dataArtikel && $dataArtikel->foto) {
            // Extract the file name from the URL
            $fileName = basename(parse_url($dataArtikel->foto, PHP_URL_PATH));
            $filePath = public_path('foto_artikel/' . $fileName);
            
            if (File::exists($filePath)) {
                return response()->file($filePath);
            } else {
                return redirect()->back()->with('error', 'Foto Artikel tidak ditemukan.');
            }
        }

        return redirect()->back()->with('error', 'Data artikel tidak ditemukan.');
    }
}
