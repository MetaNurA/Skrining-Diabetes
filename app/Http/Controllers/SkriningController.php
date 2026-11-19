<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SkriningController extends Controller
{
    /**
     * Tampilkan form skrining.
     */
    public function create()
    {
        return view('skrining.create');
    }

    /**
     * Proses submit form skrining.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usia'             => 'required|integer|min:15|max:85',
            'jenis_kelamin'    => 'required|in:L,P',
            'tinggi'           => 'required|numeric|min:100|max:250',
            'berat'            => 'required|numeric|min:20|max:300',
            'riwayat_diabetes' => 'required|in:tidak,ada',
            'hipertensi'       => 'required|in:normal,tinggi',
            'aktivitas'        => 'required|in:rutin,jarang,sedentari',
            'konsumsi'         => 'required|in:jarang,sedang,sering',
        ]);

                // Hitung BMI
        $tinggiM = $validated['tinggi'] / 100;
        $bmi = $validated['berat'] / ($tinggiM * $tinggiM);

        // ==========================================
        // TAMBAHKAN BARIS INI (Logika Penentu)
        // ==========================================
        $is_positif = ($bmi > 25 || $validated['usia'] > 40 || $validated['riwayat_diabetes'] == 'ada');

        // Data DUMMY untuk simulasi tampilan
        $hasil_ai = [
            'skor_risiko' => $is_positif ? 78 : 14,             // Ubah jadi dinamis
            'kategori' => $is_positif ? 'Risiko Tinggi' : 'Risiko Rendah', // Ubah jadi dinamis
            'confidence' => $is_positif ? '93.8%' : '94.2%',    // Ubah jadi dinamis
            'id_evaluasi' => '#DC-2025-8842',
            'waktu' => date('d M Y, H:i') . ' WIB',
            'bmi' => round($bmi, 1),
            'usia' => $validated['usia'],
            'tekanan_darah' => $validated['hipertensi'] == 'normal' ? '120/80 mmHg' : '135/88 mmHg',
            'riwayat_diabetes' => $validated['riwayat_diabetes'] == 'ada' ? 'Ada (Orang Tua)' : 'Tidak Ada',
            'aktivitas' => $validated['aktivitas'],
            'konsumsi' => $validated['konsumsi'],
            'tinggi' => $validated['tinggi'],
            'berat' => $validated['berat'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'input_riwayat_diabetes' => $validated['riwayat_diabetes'],
            'input_hipertensi' => $validated['hipertensi'],
        ];

        // ==========================================
        // PERCABANGAN VIEW (Baris 55)
        // ==========================================
        if ($is_positif) {
            return view('skrining.result-positive', compact('hasil_ai'));
        } else {
            return view('skrining.result-negative', compact('hasil_ai'));
        }
    }

    /**
     * Unduh hasil skrining sebagai PDF.
     */
    public function downloadPdf(Request $request)
    {
        $hasil_ai = $request->validate([
            'id_evaluasi' => 'required|string|max:50',
            'waktu' => 'required|string|max:60',
            'kategori' => 'required|in:Risiko Tinggi,Risiko Rendah',
            'skor_risiko' => 'required|numeric|min:0|max:100',
            'usia' => 'required|integer|min:15|max:85',
            'bmi' => 'required|numeric|min:0|max:100',
            'tekanan_darah' => 'required|string|max:30',
            'riwayat_diabetes' => 'required|string|max:50',
            'confidence' => 'nullable|string|max:10',
            'aktivitas' => 'nullable|in:rutin,jarang,sedentari',
            'konsumsi' => 'nullable|in:jarang,sedang,sering',
        ]);

        $data = ['hasil_ai' => $hasil_ai];

        $pdf = Pdf::loadView('skrining.pdf', $data);

        // Atur kertas A4 dan margin dokumen.
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
        ]);

        return $pdf->download('Hasil_Skrining_DiaCare.pdf');
    }
}