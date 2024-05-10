<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;
use App\Models\DataImunisasi;
use Illuminate\Support\Facades\Response;

class DataImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);
        $data_imunisasis = DataImunisasi::with('anak')
            ->whereHas('anak', function ($query) use ($search) {
                $query->where('id_anak', 'like', "%$search%");
            })
            ->paginate($perPage);
        $currentPage = $data_imunisasis->currentPage();
        return view('data-imunisasi', compact('data_imunisasis', 'currentPage', 'perPage'));
    }

    public function create()
    {
        $data_anaks = DataAnak::all();

        return view('create-data-imunisasi', compact('data_anaks'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'tanggal'                          => 'required',
                'id_anak'                          => 'required',
                'imunisasi_dpt_hb_hib_1_polio_2'   => 'required',
                'imunisasi_dpt_hb_hib_2_polio_3'   => 'required',
                'imunisasi_dpt_hb_hib_3_polio_4'   => 'required',
                'imunisasi_campak'                 => 'required',
                'imunisasi_dpt_hb_hib_1_dosis'     => 'required',
                'imunisasi_campak_rubella_1_dosis' => 'required',
                'imunisasi_campak_rubella_dan_dt'  => 'required',
                'imunisasi_tetanus_diphteria_td'   => 'required',
                'nama_pemeriksa'                   => 'required',
            ],
            [
                'tanggal.required'                          => 'Tanggal periksa wajib diisi.',
                'id_anak.required'                          => 'Nama anak wajib diisi.',
                'imunisasi_dpt_hb_hib_1_polio_2.required'   => 'Imunisasi DPT HB Hib 1 Polio 2 wajib diisi.',
                'imunisasi_dpt_hb_hib_2_polio_3.required'   => 'Imunisasi DPT HB Hib 2 Polio 3 wajib diisi.',
                'imunisasi_dpt_hb_hib_3_polio_4.required'   => 'Imunisasi DPT HB Hib 3 Polio 4 wajib diisi.',
                'imunisasi_campak.required'                 => 'Imunisasi Campak wajib diisi.',
                'imunisasi_dpt_hb_hib_1_dosis.required'     => 'Imunisasi DPT HB Hib 1 dosis wajib diisi.',
                'imunisasi_campak_rubella_1_dosis.required' => 'Imunisasi Campak Rubella 1 dosis wajib diisi.',
                'imunisasi_campak_rubella_dan_dt.required'  => 'Imunisasi Campak Rubella dan DT wajib diisi.',
                'imunisasi_tetanus_diphteria_td.required'   => 'Imunisasi Tetanus Diphteria TD wajib diisi.',
                'nama_pemeriksa.required'                   => 'Nama pemeriksa wajib diisi.',
            ],
        );

        DataImunisasi::create($request->all());
        toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->route('data-imunisasi.index');
    }

    public function edit($id)
    {
        $data_anaks = DataAnak::all();

        $data_imunisasis = DataImunisasi::find($id);
        return view('edit-data-imunisasi', compact('data_imunisasis', 'data_anaks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'tanggal'                          => 'required',
                'id_anak'                          => 'required',
                'imunisasi_dpt_hb_hib_1_polio_2'   => 'required',
                'imunisasi_dpt_hb_hib_2_polio_3'   => 'required',
                'imunisasi_dpt_hb_hib_3_polio_4'   => 'required',
                'imunisasi_campak'                 => 'required',
                'imunisasi_dpt_hb_hib_1_dosis'     => 'required',
                'imunisasi_campak_rubella_1_dosis' => 'required',
                'imunisasi_campak_rubella_dan_dt'  => 'required',
                'imunisasi_tetanus_diphteria_td'   => 'required',
                'nama_pemeriksa'                   => 'required',
            ],
            [
                'tanggal.required'                          => 'Tanggal periksa wajib diisi.',
                'id_anak.required'                          => 'Nama anak wajib diisi.',
                'imunisasi_dpt_hb_hib_1_polio_2.required'   => 'Imunisasi DPT HB Hib 1 Polio 2 wajib diisi.',
                'imunisasi_dpt_hb_hib_2_polio_3.required'   => 'Imunisasi DPT HB Hib 2 Polio 3 wajib diisi.',
                'imunisasi_dpt_hb_hib_3_polio_4.required'   => 'Imunisasi DPT HB Hib 3 Polio 4 wajib diisi.',
                'imunisasi_campak.required'                 => 'Imunisasi Campak wajib diisi.',
                'imunisasi_dpt_hb_hib_1_dosis.required'     => 'Imunisasi DPT HB Hib 1 dosis wajib diisi.',
                'imunisasi_campak_rubella_1_dosis.required' => 'Imunisasi Campak Rubella 1 dosis wajib diisi.',
                'imunisasi_campak_rubella_dan_dt.required'  => 'Imunisasi Campak Rubella dan DT wajib diisi.',
                'imunisasi_tetanus_diphteria_td.required'   => 'Imunisasi Tetanus Diphteria TD wajib diisi.',
                'nama_pemeriksa.required'                   => 'Nama pemeriksa wajib diisi.',
            ],
        );

        $data_imunisasis                                   = DataImunisasi::find($id);
        $data_imunisasis->tanggal                          = $request->tanggal;
        $data_imunisasis->id_anak                          = $request->id_anak;
        $data_imunisasis->imunisasi_dpt_hb_hib_1_polio_2   = $request->imunisasi_dpt_hb_hib_1_polio_2;
        $data_imunisasis->imunisasi_dpt_hb_hib_2_polio_3   = $request->imunisasi_dpt_hb_hib_2_polio_3;
        $data_imunisasis->imunisasi_dpt_hb_hib_3_polio_4   = $request->imunisasi_dpt_hb_hib_3_polio_4;
        $data_imunisasis->imunisasi_campak                 = $request->imunisasi_campak;
        $data_imunisasis->imunisasi_dpt_hb_hib_1_dosis     = $request->imunisasi_dpt_hb_hib_1_dosis;
        $data_imunisasis->imunisasi_campak_rubella_1_dosis = $request->imunisasi_campak_rubella_1_dosis;
        $data_imunisasis->imunisasi_campak_rubella_dan_dt  = $request->imunisasi_campak_rubella_dan_dt;
        $data_imunisasis->imunisasi_tetanus_diphteria_td   = $request->imunisasi_tetanus_diphteria_td;
        $data_imunisasis->nama_pemeriksa                   = $request->nama_pemeriksa;
        $data_imunisasis->save();

        toast('Data Berhasil Diubah', 'success');
        return redirect()->route('data-imunisasi.index');
    }

    public function delete($id)
    {
        $data_imunisasis = DataImunisasi::find($id);
        $data_imunisasis->delete();
        toast('Data Berhasil Dihapus', 'success');
        return redirect(route('data-imunisasi.index'));
    }

    public function download()
    {
        $data_imunisasis = DataImunisasi::with('anak')->get();
        $csvData = $this->generateCSV($data_imunisasis);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=data_imunisasi_mibu.csv',
        ];

        return Response::make($csvData, 200, $headers);
    }

    private function generateCSV($data)
    {
        $csv = '';

        $csv .= "Data Imunisasi - MIBU \n \n";

        $csv .= "No,Tanggal Periksa,Nama Anak,Imunisasi DPT-HB-Hib 1 Polio 2,Imunisasi DPT-HB-Hib 2 Polio 3,Imunisasi DPT-HB-Hib 3 Polio 4,Imunisasi Campak,Imunisasi DPT-HB-Hib 1 Dosis,Imunisasi Campak Rubella 1 Dosis,Imunisasi Campak Rubella dan DT,Imunisasi Tetanus Diphteria TD,Nama Pemeriksa\n";

        $counter = 1;

        foreach ($data as $row) {
            $id_anak = $row->anak ? $row->anak->nama_anak : 'Nama Tidak Ditemukan'; 

            $csv .= "{$counter},{$row->tanggal},{$id_anak},{$row->imunisasi_dpt_hb_hib_1_polio_2},{$row->imunisasi_dpt_hb_hib_2_polio_3},{$row->imunisasi_dpt_hb_hib_3_polio_4},{$row->imunisasi_campak},{$row->imunisasi_dpt_hb_hib_1_dosis},{$row->imunisasi_campak_rubella_1_dosis},{$row->imunisasi_campak_rubella_dan_dt},{$row->imunisasi_tetanus_diphteria_td},{$row->nama_pemeriksa}\n";

            $counter++;
        }

        return $csv;
    }
}
