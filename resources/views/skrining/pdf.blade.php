<!DOCTYPE html>
<html>
<head>
    <title>Hasil Skrining DiaCare</title>
    <style>
        /* Reset dasar dan font */
        body { font-family: sans-serif; font-size: 11px; color: #333; margin: 0; padding: 0; line-height: 1.4; }
        
        /* Header */
        .header { border-bottom: 2px solid #b81e64; padding-bottom: 10px; margin-bottom: 15px; }
        .title { color: #b81e64; font-size: 18px; font-weight: bold; margin: 0; }
        .subtitle { color: #666; font-size: 10px; margin-top: 3px; }
        
        /* Card Ringkasan */
        .card { border: 1px solid #e5e7eb; border-radius: 6px; padding: 15px; margin-bottom: 15px; background-color: #f9fafb; }
        .badge { background-color: #dcfce7; color: #166534; padding: 3px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; display: inline-block; margin-bottom: 5px; }
        .score { font-size: 28px; font-weight: bold; color: #16a34a; margin: 5px 0 0 0; }
        
        /* Tabel Data (dibuat grid agar rapi dan padat) */
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td { padding: 6px 8px; border: 1px solid #e5e7eb; vertical-align: top; }
        .label { color: #6b7280; font-size: 9px; display: block; margin-bottom: 2px; }
        .value { font-weight: bold; font-size: 11px; }
        
        /* Disclaimer */
        .disclaimer { background-color: #fdf2f8; border-left: 3px solid #b81e64; padding: 10px; margin-top: 15px; font-size: 9px; color: #4b5563; }
        .footer { text-align: center; font-size: 8px; color: #9ca3af; margin-top: 20px; border-top: 1px solid #e5e7eb; padding-top: 10px; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1 class="title">DiaCare <span style="font-size: 10px; font-weight: normal; background: #fdf2f8; padding: 2px 5px; border-radius: 4px; color: #b81e64;">CLINICAL AI</span></h1>
        <p class="subtitle">Laporan Hasil Skrining Diabetes &nbsp;|&nbsp; ID Evaluasi: <strong>{{ $hasil_ai['id_evaluasi'] }}</strong> &nbsp;|&nbsp; {{ $hasil_ai['waktu'] }}</p>
    </div>

    <!-- Card Utama -->
    <div class="card">
        <span class="badge">{{ $hasil_ai['kategori'] }}</span>
        <div style="font-weight: bold; font-size: 14px; margin-bottom: 2px;">Ringkasan Risiko</div>
        <div style="font-size: 10px; color: #555;">Pertahankan kebiasaan sehat dan lakukan skrining berkala sesuai kebutuhan.</div>
        <div class="score">{{ $hasil_ai['skor_risiko'] }}%</div>
    </div>

    <!-- Tabel Data (Layout 2 Kolom agar hemat tempat) -->
    <table>
        <tr>
            <td width="50%"><span class="label">Usia</span><span class="value">{{ $hasil_ai['usia'] }} tahun</span></td>
            <td width="50%"><span class="label">Indeks Massa Tubuh (BMI)</span><span class="value">{{ $hasil_ai['bmi'] }} kg/m²</span></td>
        </tr>
        <tr>
            <td><span class="label">Tekanan Darah</span><span class="value">{{ $hasil_ai['tekanan_darah'] }}</span></td>
            <td><span class="label">Riwayat Diabetes Keluarga</span><span class="value">{{ $hasil_ai['riwayat_diabetes'] }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Aktivitas Fisik</span><span class="value">{{ $hasil_ai['aktivitas'] }}</span></td>
            <td><span class="label">Konsumsi Makanan/Minuman Manis</span><span class="value">{{ $hasil_ai['konsumsi'] }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="label">Confidence Model</span><span class="value">{{ $hasil_ai['confidence'] }}</span></td>
        </tr>
    </table>

    <!-- Disclaimer -->
    <div class="disclaimer">
        <strong>Penafian Medis:</strong> Dokumen ini adalah hasil skrining berbasis model untuk edukasi dan stratifikasi risiko awal, bukan diagnosis medis. Hasil ini tidak menggantikan pemeriksaan atau konsultasi dengan dokter maupun tenaga kesehatan profesional.
    </div>

    <!-- Footer -->
    <div class="footer">
        Dihasilkan oleh DiaCare - Simpan dokumen ini secara aman karena memuat informasi kesehatan.
    </div>

</body>
</html>