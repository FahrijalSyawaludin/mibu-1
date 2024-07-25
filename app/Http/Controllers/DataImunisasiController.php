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
        $data_imunisasis = DataImunisasi::where('nama_anak', 'like', "%$search%")->paginate($perPage);
        $currentPage = $data_imunisasis->currentPage();
        return view('data-imunisasi', compact('data_imunisasis', 'currentPage'));
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
                'tanggal' => 'required',
                'nama_anak' => 'required',
                'id_anak'    => 'required|exists:data_anaks,id',
                'nama_pemeriksa' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal periksa wajib diisi.',
                'nama_anak.required' => 'Nama anak wajib diisi.',
                'nama_pemeriksa.required' => 'Nama pemeriksa wajib diisi.',
            ],
        );

        $data = $request->all();
        $data['nama_anak'] = DataAnak::find($request->id_anak)->nama_anak;

        DataImunisasi::create($data);
        toast('Data Berhasil Ditambahkan', 'success');
        return redirect()->route('data-imunisasi.index');
    }

    public function edit($id)
    {
        // Query untuk mendapatkan data anak-anak dari tabel `data_anaks`
        $data_anaks = DataAnak::all();

        $data_imunisasis = DataImunisasi::find($id);
        return view('edit-data-imunisasi', compact('data_imunisasis', 'data_anaks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'tanggal' => 'required',
                'nama_anak' => 'required',
                'id_anak'    => 'required|exists:data_anaks,id',
                'nama_pemeriksa' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal periksa wajib diisi.',
                'nama_anak.required' => 'Nama anak wajib diisi.',
                'nama_pemeriksa.required' => 'Nama pemeriksa wajib diisi.',
            ],
        );

        $data_imunisasis = DataImunisasi::find($id);
        $data_imunisasis->tanggal = $request->tanggal;
        $data_imunisasis->nama_anak = $request->nama_anak;
        $data_imunisasis->id_anak = $request->id_anak;
        $data_imunisasis->hepatitis_b = $request->hepatitis_b;
        $data_imunisasis->tanggal_imunisasi_hepatitis_b = $request->tanggal_imunisasi_hepatitis_b;
        $data_imunisasis->bcg = $request->bcg;
        $data_imunisasis->tanggal_imunisasi_bcg = $request->tanggal_imunisasi_bcg;
        $data_imunisasis->polio_tetes_1 = $request->polio_tetes_1;
        $data_imunisasis->tanggal_imunisasi_polio_tetes_1 = $request->tanggal_imunisasi_polio_tetes_1;
        $data_imunisasis->dpt_hb_hib_1 = $request->dpt_hb_hib_1;
        $data_imunisasis->tanggal_imunisasi_dpt_hb_hib_1 = $request->tanggal_imunisasi_dpt_hb_hib_1;
        $data_imunisasis->polio_tetes_2 = $request->polio_tetes_2;
        $data_imunisasis->tanggal_imunisasi_polio_tetes_2 = $request->tanggal_imunisasi_polio_tetes_2;
        $data_imunisasis->rota_virus_1 = $request->rota_virus_1;
        $data_imunisasis->tanggal_imunisasi_rota_virus_1 = $request->tanggal_imunisasi_rota_virus_1;
        $data_imunisasis->pcv_1 = $request->pcv_1;
        $data_imunisasis->tanggal_imunisasi_pcv_1 = $request->tanggal_imunisasi_pcv_1;
        $data_imunisasis->dpt_hb_hib_2 = $request->dpt_hb_hib_2;
        $data_imunisasis->tanggal_imunisasi_dpt_hb_hib_2 = $request->tanggal_imunisasi_dpt_hb_hib_2;
        $data_imunisasis->polio_tetes_3 = $request->polio_tetes_3;
        $data_imunisasis->tanggal_imunisasi_polio_tetes_3 = $request->tanggal_imunisasi_polio_tetes_3;
        $data_imunisasis->rota_virus_2 = $request->rota_virus_2;
        $data_imunisasis->tanggal_imunisasi_rota_virus_2 = $request->tanggal_imunisasi_rota_virus_2;
        $data_imunisasis->pcv_2 = $request->pcv_2;
        $data_imunisasis->tanggal_imunisasi_pcv_2 = $request->tanggal_imunisasi_pcv_2;
        $data_imunisasis->dpt_hb_hib_3 = $request->dpt_hb_hib_3;
        $data_imunisasis->tanggal_imunisasi_dpt_hb_hib_3 = $request->tanggal_imunisasi_dpt_hb_hib_3;
        $data_imunisasis->polio_tetes_4 = $request->polio_tetes_4;
        $data_imunisasis->tanggal_imunisasi_polio_tetes_4 = $request->tanggal_imunisasi_polio_tetes_4;
        $data_imunisasis->polio_suntik_1 = $request->polio_suntik_1;
        $data_imunisasis->tanggal_imunisasi_polio_suntik_1 = $request->tanggal_imunisasi_polio_suntik_1;
        $data_imunisasis->rota_virus_3 = $request->rota_virus_3;
        $data_imunisasis->tanggal_imunisasi_rota_virus_3 = $request->tanggal_imunisasi_rota_virus_3;
        $data_imunisasis->campak_rubella = $request->campak_rubella;
        $data_imunisasis->tanggal_imunisasi_campak_rubella = $request->tanggal_imunisasi_campak_rubella;
        $data_imunisasis->polio_suntik_2 = $request->polio_suntik_2;
        $data_imunisasis->tanggal_imunisasi_polio_suntik_2 = $request->tanggal_imunisasi_polio_suntik_2;
        $data_imunisasis->japanese_encephalitis = $request->japanese_encephalitis;
        $data_imunisasis->tanggal_imunisasi_japanese_encephalitis = $request->tanggal_imunisasi_japanese_encephalitis;
        $data_imunisasis->pcv_3 = $request->pcv_3;
        $data_imunisasis->tanggal_imunisasi_pcv_3 = $request->tanggal_imunisasi_pcv_3;
        $data_imunisasis->dpt_hb_hib_lanjutan = $request->dpt_hb_hib_lanjutan;
        $data_imunisasis->tanggal_imunisasi_dpt_hb_hib_lanjutan = $request->tanggal_imunisasi_dpt_hb_hib_lanjutan;
        $data_imunisasis->campak_rubella_lanjutan = $request->campak_rubella_lanjutan;
        $data_imunisasis->tanggal_imunisasi_campak_rubella_lanjutan = $request->tanggal_imunisasi_campak_rubella_lanjutan;
        $data_imunisasis->nama_pemeriksa = $request->nama_pemeriksa;
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
        $data_imunisasis = DataImunisasi::all();

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

        $csv .= "No,
        Tanggal Periksa,
        Nama Anak,
        Imunisasi Hepatitis B,
        Imunisasi BCG,
        Imunisasi Polio Tetes 1,
        Imunisasi DPT-HB-Hib 1,
        Imunisasi Polio Tetes 2,
        Imunisasi Rota virus 1,
        Imunisasi PCV 1,
        Imunisasi DPT-HB-Hib 2,
        Imunisasi Polio Tetes 3,
        Imunisasi Rotavirus 2,
        Imunisasi PCV 2,
        Imunisasi DPT-HB-Hib 3,
        Imunisasi Polio Tetes 4,
        Imunisasi Polio Suntik 1,
        Imunisasi Rotavirus 3,
        Imunsasi Campak Rubella,
        Imunisasi Polio Suntik 2,
        Imunisasi Japanese Encephalitis,
        Imunisasi PCV 3,
        Imunisasi DPT-HB-Hib Lanjutan,
        Imunisasi Campak Rubella Lanjutan,
        Nama Pemeriksa\n";

        $counter = 1;

        foreach ($data as $row) {
            $csv .= "{$counter},
            {$row->tanggal},
            {$row->nama_anak},
            {$row->hepatitis_b},
            {$row->bcg},
            {$row->polio_tetes_1},
            {$row->dpt_hb_hib_1},
            {$row->polio_tetes_2},
            {$row->rota_virus_1},
            {$row->pcv_1},
            {$row->dpt_hb_hib_2},
            {$row->polio_tetes_3},
            {$row->rota_virus_2},
            {$row->pcv_2},
            {$row->dpt_hb_hib_3},
            {$row->polio_tetes_4},
            {$row->polio_suntik_1},
            {$row->rota_virus_3},
            {$row->campak_rubella},
            {$row->polio_suntik_2},
            {$row->japanese_encephalitis},
            {$row->pcv_3},
            {$row->dpt_hb_hib_lanjutan},
            {$row->campak_rubella_lanjutan},
            {$row->nama_pemeriksa}\n";

            $counter++;
        }

        return $csv;
    }
}
