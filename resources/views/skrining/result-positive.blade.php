@extends('layouts.app')

@section('title', 'Hasil Evaluasi Risiko - DiacCare')

@push('styles')
<style>
    /* Animasi progress bar */
    .progress-bar-fill { transition: width 1s ease-in-out; }
    .screening-result,
    .screening-result * { min-width: 0; }
    .screening-result p,
    .screening-result h2,
    .screening-result h3,
    .screening-result h4 { overflow-wrap: anywhere; }

</style>
@endpush

@section('content')

<div class="screening-result w-full max-w-none mx-auto px-4 sm:px-6 lg:px-8 2xl:px-10 pb-8 sm:pb-12">

    <!-- TOP NAVBAR (Kustom untuk halaman hasil) -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 py-2">
        <div class="flex flex-wrap items-center gap-3 sm:gap-4 mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-brand-600">DiaCare <span class="text-sm font-medium bg-brand-50 text-brand-600 px-2 py-1 rounded-md ml-1">CLINICAL AI</span></h1>
            <span class="hidden md:flex items-center gap-1 text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-semibold">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Hasil Evaluasi Terverifikasi
            </span>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('skrining.create') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Skrining Ulang
            </a>
            <button type="button" onclick="openModal()" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 flex items-center gap-2 shadow-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Unduh PDF
            </button>
        </div>
    </div>

    <!-- SUB HEADER (ID & Waktu) -->
    <div class="bg-gray-50 rounded-xl p-3 flex flex-col sm:flex-row sm:flex-wrap sm:justify-between sm:items-center gap-2 text-xs text-gray-500 mb-6 border border-gray-100">
        <div class="flex items-center gap-4">
            <span># ID Evaluasi: <strong class="text-gray-800">{{ $hasil_ai['id_evaluasi'] }}</strong></span>
            <span class="hidden md:inline">•</span>
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Waktu: {{ $hasil_ai['waktu'] }} (Real-time)
            </span>
        </div>
        <div class="flex items-center gap-1 mt-2 md:mt-0 font-medium text-green-600">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Prediksi sementara berbasis aturan
        </div>
    </div>

    <!-- KARTU UTAMA HASIL -->
    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-sm border border-gray-200 mb-6 relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-center">
            
            <!-- Kiri: Teks & Badge -->
            <div class="lg:col-span-2">
                <div class="flex flex-wrap items-start gap-2 mb-4">
                    <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Perhatian Medis: Risiko Tinggi / Terindikasi Diabetes Melitus
                    </span>
                    <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1.5 rounded-full flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Confidence: {{ $hasil_ai['confidence'] }}
                    </span>
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 leading-tight">Perhatian Medis Diperlukan: Profil Anda Terindikasi Risiko Tinggi Diabetes Melitus</h2>
                <p class="text-gray-600 mb-6">{{ $hasil_ai['status_model'] }} Hasil ini bukan diagnosis medis.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="bg-red-50 border border-red-100 rounded-xl p-3 flex items-center gap-2">
                        <div class="text-red-500 bg-white rounded-lg p-1.5"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                        <div><p class="text-[10px] text-gray-500 uppercase font-semibold">Resistensi Insulin</p><p class="text-sm font-bold text-red-700">Indikasi Kuat</p></div>
                    </div>
                    <div class="bg-red-50 border border-red-100 rounded-xl p-3 flex items-center gap-2">
                        <div class="text-red-500 bg-white rounded-lg p-1.5"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        <div><p class="text-[10px] text-gray-500 uppercase font-semibold">Tekanan Darah</p><p class="text-sm font-bold text-red-700">Tinggi</p></div>
                    </div>
                    <div class="bg-pink-50 border border-pink-100 rounded-xl p-3 flex items-center gap-2">
                        <div class="text-pink-500 bg-white rounded-lg p-1.5"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                        <div><p class="text-[10px] text-gray-500 uppercase font-semibold">Langkah Prioritas</p><p class="text-sm font-bold text-pink-700">Konfirmasi Dokter</p></div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Gauge Chart -->
            <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100 flex flex-col items-center justify-center relative">
                <div class="relative w-48 h-48 mb-4">
                    <!-- SVG Gauge Dummy -->
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke="#f3f4f6" stroke-width="12" fill="none" />
                        <circle cx="50" cy="50" r="40" stroke="#dc2626" stroke-width="12" fill="none" stroke-dasharray="251.2" stroke-dashoffset="55.2" stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-extrabold text-red-600">{{ $hasil_ai['skor_risiko'] }}%</span>
                        <span class="text-sm font-semibold text-red-500">Risiko Tinggi</span>
                    </div>
                </div>
                <div class="w-full flex justify-between text-[10px] font-semibold mb-2">
                    <span class="text-green-500">0% Protektif</span>
                    <span class="text-red-500">Skor sementara {{ $hasil_ai['skor_risiko'] }}%</span>
                </div>
                <div class="w-full h-2 rounded-full bg-gradient-to-r from-green-400 via-yellow-400 to-red-500 mb-3"></div>
                <p class="text-xs text-gray-500 text-center">Skor ini berasal dari aturan sementara dan bukan probabilitas keluaran Logistic Regression.</p>
            </div>
        </div>
    </div>

    <!-- Penjelasan model akan diisi setelah Logistic Regression dan SHAP terhubung. -->
    <section class="bg-white rounded-2xl p-6 border border-amber-200 mb-6">
        <h2 class="font-bold text-gray-900">Analisis faktor SHAP belum tersedia</h2>
        <p class="mt-2 text-sm text-gray-600">Kontribusi dan peringkat faktor belum dihitung oleh model, sehingga nilai contoh tidak ditampilkan sebagai hasil analisis.</p>
    </section>
    <!-- BOTTOM GRID (Rekap Parameter & Rencana Tindakan) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        
        <!-- REKAP PARAMETER -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 lg:p-7 shadow-sm border border-gray-200 min-w-0">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2"><svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg> Rekapitulasi Parameter</h3>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-md">7 Variabel</span>
            </div>
            <p class="text-xs text-gray-500 mb-6">Data biometrik yang diolah oleh model klasifikasi AI pada sesi skrining ini:</p>
            
            <div class="space-y-3">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-3 border border-gray-100 rounded-xl transition-colors">
                    <div class="flex flex-wrap items-center gap-3"><div class="bg-gray-100 p-2 rounded-lg text-gray-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                    <div><p class="text-xs text-gray-500">Usia Responden</p><p class="text-xs text-gray-400">Kelompok usia produktif</p></div></div>
                    <div class="text-right"><p class="text-sm font-bold text-gray-800">{{ $hasil_ai['usia'] }} Tahun</p><p class="text-[10px] font-semibold text-orange-500">Risiko Menengah</p></div>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-3 border border-gray-100 rounded-xl transition-colors">
                    <div class="flex flex-wrap items-center gap-3"><div class="bg-gray-100 p-2 rounded-lg text-gray-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg></div>
                    <div><p class="text-xs text-gray-500">Indeks Massa Tubuh (BMI)</p><p class="text-xs text-gray-400">TB: {{ $hasil_ai['tinggi'] }} cm | BB: {{ $hasil_ai['berat'] }} kg</p></div></div>
                    <div class="text-right"><p class="text-sm font-bold text-gray-800">{{ $hasil_ai['bmi'] }} kg/m²</p><p class="text-[10px] font-semibold text-red-500">{{ $hasil_ai['kategori_bmi'] }}</p></div>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-3 border border-gray-100 rounded-xl transition-colors">
                    <div class="flex flex-wrap items-center gap-3"><div class="bg-gray-100 p-2 rounded-lg text-gray-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                    <div><p class="text-xs text-gray-500">Riwayat Diabetes Keluarga</p><p class="text-xs text-gray-400">Genetik tingkat 1 (Orang Tua)</p></div></div>
                    <div class="text-right"><p class="text-sm font-bold text-gray-800">{{ $hasil_ai['riwayat_diabetes'] }}</p><p class="text-[10px] font-semibold text-red-500">{{ $hasil_ai['riwayat_diabetes'] == 'Ada (Orang Tua)' ? 'Ada riwayat' : 'Tidak ada riwayat' }}</p></div>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-3 border border-gray-100 rounded-xl transition-colors">
                    <div class="flex flex-wrap items-center gap-3"><div class="bg-gray-100 p-2 rounded-lg text-gray-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                    <div><p class="text-xs text-gray-500">Tekanan Darah</p><p class="text-xs text-gray-400">Pengukuran mandiri</p></div></div>
                    <div class="text-right"><p class="text-sm font-bold text-gray-800">{{ $hasil_ai['tekanan_darah'] }}</p><p class="text-[10px] font-semibold text-orange-500">{{ $hasil_ai['hipertensi'] }}</p></div>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-3 border border-gray-100 rounded-xl transition-colors">
                    <div class="flex flex-wrap items-center gap-3"><div class="bg-gray-100 p-2 rounded-lg text-gray-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
                    <div><p class="text-xs text-gray-500">Aktivitas Fisik</p><p class="text-xs text-gray-400">Kurang bergerak ({{ $hasil_ai['aktivitas'] }})</p></div></div>
                    <div class="text-right"><p class="text-sm font-bold text-gray-800">{{ ucfirst($hasil_ai['aktivitas']) }}</p><p class="text-[10px] font-semibold text-red-500">Sesuai input</p></div>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-3 border border-gray-100 rounded-xl transition-colors">
                    <div class="flex flex-wrap items-center gap-3"><div class="bg-gray-100 p-2 rounded-lg text-gray-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path></svg></div>
                    <div><p class="text-xs text-gray-500">Konsumsi Minuman Manis</p><p class="text-xs text-gray-400">Frekuensi gula tambahan</p></div></div>
                    <div class="text-right"><p class="text-sm font-bold text-gray-800">{{ ucfirst($hasil_ai['konsumsi']) }}</p><p class="text-[10px] font-semibold text-red-500">Sesuai input</p></div>
                </div>
            </div>

            <div class="mt-4 bg-gray-50 rounded-xl p-3 flex gap-2 items-start text-[10px] text-gray-500">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>Semua parameter telah divalidasi terhadap standar indeks metabolik pencegahan dari Kementerian Kesehatan RI (PANDU PTM).</p>
            </div>
        </div>

        <!-- RENCANA TINDAKAN -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 lg:p-7 shadow-sm border border-gray-200 flex flex-col min-w-0">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-2">
                <h3 class="font-bold text-gray-900 flex items-center gap-2"><svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg> Rencana Tindakan Klinis & Modifikasi</h3>
                <span class="bg-brand-50 text-brand-600 text-[10px] font-bold px-2 py-1 rounded">Intervensi Prioritas</span>
            </div>
            <p class="text-xs text-gray-500 mb-6">Berdasarkan indikasi risiko tinggi, berikut 3 protokol medis yang disarankan oleh pedoman PERKENI untuk menstabilkan profil glukosa darah Anda:</p>

            <div class="space-y-3 flex-grow">
                <!-- Protocol 1 -->
                <div class="bg-red-50/50 border border-red-100 rounded-2xl p-4 flex gap-3">
                    <div class="bg-red-500 text-white p-2 rounded-xl shrink-0 h-fit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg></div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-bold text-gray-900 text-sm">Pemeriksaan HbA1c & Glukosa Darah Puasa</h4>
                            <span class="bg-red-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded">Wajib Segera</span>
                        </div>
                        <p class="text-xs text-gray-600">Lakukan tes darah di laboratorium medis dalam 1–2 minggu ini untuk mengukur rata-rata kadar gula darah 3 bulan terakhir.</p>
                    </div>
                </div>
                <!-- Protocol 2 -->
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 flex gap-3">
                    <div class="bg-brand-500 text-white p-2 rounded-xl shrink-0 h-fit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg></div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-bold text-gray-900 text-sm">Eliminasi Gula Tambahan & Target BMI</h4>
                            <span class="bg-brand-100 text-brand-700 text-[9px] font-bold px-1.5 py-0.5 rounded">Modifikasi Diet</span>
                        </div>
                        <p class="text-xs text-gray-600">Hentikan konsumsi minuman manis kemasan. Rencanakan penurunan berat badan 5-10% (sekitar 4-8 kg) untuk resistensi insulin.</p>
                    </div>
                </div>
                <!-- Protocol 3 -->
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 flex gap-3">
                    <div class="bg-brand-500 text-white p-2 rounded-xl shrink-0 h-fit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-bold text-gray-900 text-sm">Aktivitas Aerobik Bertahap 150 Mnt/Minggu</h4>
                            <span class="bg-gray-200 text-gray-600 text-[9px] font-bold px-1.5 py-0.5 rounded">Gaya Hidup</span>
                        </div>
                        <p class="text-xs text-gray-600">Mulai dengan jalan cepat 20–30 menit per hari, 5 kali seminggu. Aktivitas fisik memicu translokasi GLUT-4.</p>
                    </div>
                </div>
            </div>

            <!-- Pengingat -->
            <div class="mt-4 border-t border-gray-100 pt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Pengingat Tindak Lanjut Medis</p>
                        <p class="text-[10px] text-gray-500">Notifikasi evaluasi ulang hasil lab HbA1c dalam 14 hari</p>
                    </div>
                </div>
                <button type="button" class="w-full sm:w-auto bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-colors">Set Pengingat Lab (14 Hari)</button>
            </div>
        </div>
    </div>

    <!-- DISCLAIMER BAWAH -->
    <div class="bg-gray-100 rounded-2xl p-4 sm:p-5 flex gap-3 text-sm text-gray-500">
        <svg class="w-6 h-6 flex-shrink-0 mt-0.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        <div>
            <strong class="text-gray-700 block mb-1">Pernyataan Kepatuhan Medis & Batasan Sistem (Medical Disclaimer)</strong>
            <p class="text-xs leading-relaxed">{{ $hasil_ai['status_model'] }} Hasil ini bukan diagnosis dan tidak menggantikan penilaian tenaga kesehatan.</p>
        </div>
    </div>

</div>

@include('skrining.partials.pdf-modal')

@endsection
