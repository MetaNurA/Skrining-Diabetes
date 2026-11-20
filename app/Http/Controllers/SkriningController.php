<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SkriningResult;

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
            'usia'             => 'required|integer|min:10|max:19',
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
        
        // Klasifikasi sementara berbasis aturan; ganti dengan hasil model saat model tersedia.
        $is_positif = ($bmi > 25 || $validated['riwayat_diabetes'] == 'ada');
        
        $skor = $is_positif ? 78 : 14;
        $kategori = $is_positif ? 'Risiko Tinggi' : 'Risiko Rendah';
        $confidence = 'Belum tersedia (model belum terhubung)';
        $bmiRounded = round($bmi, 1);
        $kategoriBmi = match (true) {
            $bmi < 18.5 => 'Berat badan kurang',
            $bmi < 23 => 'Normal',
            $bmi < 25 => 'Overweight',
            default => 'Obesitas',
        };
        $evaluation_id = '#DC-' . date('Y') . '-' . rand(1000, 9999);

        // ==========================================
        // SIMPAN KE DATABASE
        // ==========================================
        $hasil_db = SkriningResult::create([
            'evaluation_id' => $evaluation_id,
            'usia' => $validated['usia'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tinggi' => $validated['tinggi'],
            'berat' => $validated['berat'],
            'bmi' => $bmiRounded,
            'riwayat_diabetes' => $validated['riwayat_diabetes'],
            'hipertensi' => $validated['hipertensi'],
            'aktivitas' => $validated['aktivitas'],
            'konsumsi' => $validated['konsumsi'],
            'skor_risiko' => $skor,
            'kategori' => $kategori,
            'confidence' => $confidence,
        ]);

        // Siapkan data untuk view
        $hasil_ai = [
            'id_evaluasi' => $evaluation_id,
            'skor_risiko' => $skor,
            'kategori' => $kategori,
            'confidence' => $confidence,
            'waktu' => $hasil_db->created_at->format('d M Y, H:i') . ' WIB',
            'bmi' => round($bmi, 1),
            'usia' => $validated['usia'],
            'tekanan_darah' => $validated['hipertensi'] == 'normal' ? '120/80 mmHg' : '135/88 mmHg',
            'riwayat_diabetes' => $validated['riwayat_diabetes'] == 'ada' ? 'Ada (Orang Tua)' : 'Tidak Ada',
            'aktivitas' => $validated['aktivitas'],
            'konsumsi' => $validated['konsumsi'],
            'jenis_kelamin' => $validated['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan',
            'tinggi' => $validated['tinggi'],
            'berat' => $validated['berat'],
            'kategori_bmi' => $kategoriBmi,
            'hipertensi' => $validated['hipertensi'] == 'tinggi' ? 'Ada riwayat / tinggi' : 'Normal',
            'status_model' => 'Klasifikasi sementara berbasis aturan; Logistic Regression dan SHAP belum terhubung.',
        ];

        // Arahkan ke halaman hasil
        if ($is_positif) {
            return view('skrining.result-positive', compact('hasil_ai')); 
        } else {
            return view('skrining.result-negative', compact('hasil_ai')); 
        }
    }

    /** Unduh laporan dari hasil skrining yang sudah tersimpan. */
    public function downloadPdf(Request $request)
    {
        $validated = $request->validate([
            'id_evaluasi' => 'required|string',
        ]);

        $hasil = SkriningResult::where('evaluation_id', $validated['id_evaluasi'])->firstOrFail();
        $tinggiM = $hasil->tinggi / 100;
        $bmi = $hasil->berat / ($tinggiM * $tinggiM);
        $kategoriBmi = match (true) {
            $bmi < 18.5 => 'Berat badan kurang',
            $bmi < 23 => 'Normal',
            $bmi < 25 => 'Overweight',
            default => 'Obesitas',
        };

        $hasil_ai = [
            'id_evaluasi' => $hasil->evaluation_id,
            'waktu' => $hasil->created_at->format('d M Y, H:i') . ' WIB',
            'kategori' => $hasil->kategori,
            'skor_risiko' => $hasil->skor_risiko,
            'usia' => $hasil->usia,
            'bmi' => round($bmi, 1),
            'tinggi' => $hasil->tinggi,
            'berat' => $hasil->berat,
            'kategori_bmi' => $kategoriBmi,
            'tekanan_darah' => $hasil->hipertensi == 'normal' ? 'Normal' : 'Ada riwayat / tinggi',
            'riwayat_diabetes' => $hasil->riwayat_diabetes == 'ada' ? 'Ada' : 'Tidak ada',
            'confidence' => $hasil->confidence,
            'aktivitas' => $hasil->aktivitas,
            'konsumsi' => $hasil->konsumsi,
        ];

        return Pdf::loadView('skrining.pdf', compact('hasil_ai'))
            ->download('hasil-skrining-' . $hasil->evaluation_id . '.pdf');
    }
}
