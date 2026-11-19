@extends('layouts.app')

@section('title', 'Portal Skrining Mandiri Diabetes Mellitus Remaja')

@push('styles')
<style>
    /* Custom Radio Button Styling */
    input[type="radio"]:checked + div {
        border-color: #b81e64;
        background-color: #fdf2f8;
    }
    input[type="radio"]:checked + div .radio-indicator {
        border-color: #b81e64;
        background-color: #b81e64;
    }
    input[type="radio"]:checked + div .radio-indicator::after {
        content: '';
        display: block;
        width: 6px;
        height: 6px;
        background-color: white;
        border-radius: 50%;
        margin: auto;
        margin-top: 3px;
    }
</style>
@endpush

@section('content')

<form action="{{ route('skrining.store') }}" method="POST">
    @csrf
    <div class="w-full max-w-none mx-auto px-4 sm:px-6 lg:px-8 2xl:px-10">

        <!-- HEADER -->
        <div class="bg-white rounded-2xl p-4 flex flex-col md:flex-row items-center justify-between shadow-sm mb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-brand-50 rounded-xl flex items-center justify-center text-brand-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl font-bold text-gray-900">Portal Skrining Mandiri Diabetes Mellitus Remaja</h1>
                        <span class="bg-brand-50 text-brand-600 text-xs font-semibold px-2 py-1 rounded-md">AKTIF</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Berbasis Algoritma Logistic Regression & Explainable AI (SHAP) sesuai parameter Kemenkes RI.</p>
                </div>
            </div>
            <div class="flex items-center gap-4 mt-4 md:mt-0 text-sm font-medium">
                <span class="flex items-center gap-1 text-gray-600"><svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Akurasi 92.4%</span>
                <span class="flex items-center gap-1 text-gray-600"><svg class="w-4 h-4 text-brand-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg> 100% Anonim</span>
            </div>
        </div>

        <!-- MAIN CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 xl:gap-8">

            <!-- LEFT SIDEBAR -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Progres -->
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800">Kelengkapan Formulir</h3>
                        <span class="text-brand-500 font-bold">100%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-4">
                        <div class="bg-brand-500 h-2.5 rounded-full" style="width: 100%"></div>
                    </div>
                    <p class="text-sm text-gray-500 leading-relaxed">Lengkapi seluruh 7 indikator biologis dan gaya hidup di samping untuk mengaktifkan kalkulasi inferensi model machine learning.</p>
                </div>

                <!-- 7 Parameter -->
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        7 Parameter Klinis
                    </h3>
                    <p class="text-xs text-gray-500 mb-6">Variabel prediktif diadopsi dari skor risiko Finnish Diabetes Risk Score (FINDRISC) yang disesuaikan untuk populasi Indonesia.</p>

                    <div class="space-y-5">
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">1</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Usia Biologis: Risiko meningkat gradual pada usia >35 tahun karena penurunan sensitivitas insulin.</h4></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">2</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Jenis Kelamin: Perbedaan profil adipositas visceral antara laki-laki dan perempuan.</h4></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">3</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Indeks Massa Tubuh (BMI): Cut-off Asia-Pasifik (Normal: 18.5 - 22.9, Overweight: >23, Obesitas >25).</h4></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">4</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Riwayat Diabetes Keluarga: Indikator genetik kuat dari orang tua atau saudara kandung.</h4></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">5</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Riwayat Hipertensi: Tekanan darah >140/90 mmHg berkoelasi erat dengan sindrom metabolik.</h4></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">6</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Aktivitas Fisik: Aktivitas aerobik minimal 150 menit/minggu meningkatkan translokasi GLUT-4.</h4></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold flex items-center justify-center mt-0.5">7</span>
                            <div><h4 class="text-sm font-semibold text-gray-800">Pola Konsumsi Manis: Asupan gula bebas tinggi secara konsisten membebani sel beta pankreas.</h4></div>
                        </div>
                    </div>
                </div>

                <!-- Privacy Card -->
                <div class="bg-[#fdf2f8] border border-brand-100 rounded-2xl p-6">
                    <h4 class="font-semibold text-brand-700 flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Keamanan Data & Privasi Terjamin
                    </h4>
                    <p class="text-sm text-brand-600/80 leading-relaxed">Data skrining diproses secara anonim di sisi perangkat pengguna tanpa menyimpan identitas personal (PII).</p>
                </div>
            </div>

            <!-- RIGHT FORM -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">Formulir Skrining Parameter Klinis</h2>
                            <p class="text-gray-500">Isi seluruh data objektif berikut dengan akurat.</p>
                        </div>
                        <span class="bg-brand-50 text-brand-600 text-sm font-medium px-3 py-1.5 rounded-full flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Mandiri
                        </span>
                    </div>

                    <div class="space-y-8">

                        <!-- 1. Usia -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">1</span>
                                <label class="font-semibold text-gray-800">Usia Pengguna (Tahun)</label>
                                <span class="ml-auto text-xs text-gray-400">Rentang evaluasi: 15 - 85 thn</span>
                            </div>
                            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden max-w-xs">
                                <button type="button" class="px-4 py-3 bg-gray-50 hover:bg-gray-100 text-brand-500 font-bold text-lg">-</button>
                                <input type="number" name="usia" value="30" class="w-full text-center py-3 font-semibold text-lg focus:outline-none" min="15" max="85">
                                <button type="button" class="px-4 py-3 bg-gray-50 hover:bg-gray-100 text-brand-500 font-bold text-lg">+</button>
                            </div>
                        </div>

                        <!-- 2. Jenis Kelamin -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">2</span>
                                <label class="font-semibold text-gray-800">Jenis Kelamin Biologis</label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="L" class="peer sr-only" checked>
                                    <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50">
                                        <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                        <span class="font-medium text-gray-700">♂ Laki-laki</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="P" class="peer sr-only">
                                    <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50">
                                        <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                        <span class="font-medium text-gray-700">♀ Perempuan</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 3. Antropometri -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">3</span>
                                <label class="font-semibold text-gray-800">Antropometri (Tinggi, Berat, & Indeks Massa Tubuh)</label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">Tinggi Badan (cm)</label>
                                    <div class="relative">
                                        <input type="number" name="tinggi" value="168" class="w-full border border-gray-200 rounded-xl p-3 pr-12 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500">
                                        <span class="absolute right-4 top-3.5 text-gray-400 text-sm">cm</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 mb-1 block">Berat Badan (kg)</label>
                                    <div class="relative">
                                        <input type="number" name="berat" value="65" class="w-full border border-gray-200 rounded-xl p-3 pr-12 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500">
                                        <span class="absolute right-4 top-3.5 text-gray-400 text-sm">kg</span>
                                    </div>
                                </div>
                            </div>

                            <!-- BMI Result -->
                            <div class="bg-[#fdf2f8] rounded-xl p-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-brand-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Kalkulasi Indeks Massa Tubuh (BMI)</p>
                                        <p class="font-bold text-gray-900 text-lg">23.0 <span class="text-sm font-normal text-gray-500">kg/m²</span></p>
                                    </div>
                                </div>
                                <span class="bg-brand-100 text-brand-700 text-xs font-semibold px-3 py-1 rounded-full">Overweight (23.0 - 24.9)</span>
                            </div>
                        </div>

                        <!-- 4. Riwayat Diabetes -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">4</span>
                                <label class="font-semibold text-gray-800">Riwayat Diabetes Keluarga Kandung (Orang Tua / Saudara Kandung)</label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="riwayat_diabetes" value="tidak" class="peer sr-only" checked>
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50">
                                        <div class="flex items-center gap-3 mb-1">
                                            <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800">Tidak Ada</span>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-8">Tidak ada garis langsung DM</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="riwayat_diabetes" value="ada" class="peer sr-only">
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50">
                                        <div class="flex items-center gap-3 mb-1">
                                            <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800">Ada Riwayat</span>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-8">Ayah, Ibu, atau Saudara Kandung</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 5. Hipertensi -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">5</span>
                                <label class="font-semibold text-gray-800">Riwayat Tekanan Darah Tinggi / Hipertensi</label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="hipertensi" value="normal" class="peer sr-only" checked>
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50">
                                        <div class="flex items-center gap-3 mb-1">
                                            <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800">Normal (<120/80 mmHg)</span>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-8">Tanpa obat antihipertensi</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="hipertensi" value="tinggi" class="peer sr-only">
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50">
                                        <div class="flex items-center gap-3 mb-1">
                                            <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800">Ada Riwayat / Tinggi</span>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-8">>140/90 atau konsumsi obat</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 6. Aktivitas Fisik -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">6</span>
                                <label class="font-semibold text-gray-800">Frekuensi Aktivitas Fisik / Olahraga</label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="aktivitas" value="rutin" class="peer sr-only" checked>
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50 h-full">
                                        <div class="flex items-center gap-2 mb-1">
                                            <div class="radio-indicator w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800 text-sm">Rutin</span>
                                        </div>
                                        <span class="text-xs text-gray-500">≥30 menit/hari (min. 3x seminggu)</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="aktivitas" value="jarang" class="peer sr-only">
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50 h-full">
                                        <div class="flex items-center gap-2 mb-1">
                                            <div class="radio-indicator w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800 text-sm">Jarang</span>
                                        </div>
                                        <span class="text-xs text-gray-500">1-2 kali seminggu, intensitas ringan</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="aktivitas" value="sedentari" class="peer sr-only">
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50 h-full">
                                        <div class="flex items-center gap-2 mb-1">
                                            <div class="radio-indicator w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800 text-sm">Sedentari</span>
                                        </div>
                                        <span class="text-xs text-gray-500">Hampir tidak pernah olahraga aktif</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 7. Pola Konsumsi -->
                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500 text-white text-sm font-bold flex items-center justify-center">7</span>
                                <label class="font-semibold text-gray-800">Pola Konsumsi Minuman / Makanan Manis & Ultra-Proses</label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="konsumsi" value="jarang" class="peer sr-only" checked>
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50 h-full">
                                        <div class="flex items-center gap-2 mb-1">
                                            <div class="radio-indicator w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800 text-sm">Jarang</span>
                                        </div>
                                        <span class="text-xs text-gray-500">&lt;2 kali seminggu / air putih utama</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="konsumsi" value="sedang" class="peer sr-only">
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50 h-full">
                                        <div class="flex items-center gap-2 mb-1">
                                            <div class="radio-indicator w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800 text-sm">Sedang</span>
                                        </div>
                                        <span class="text-xs text-gray-500">3-5 kali seminggu (kopi susu/teh manis)</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="konsumsi" value="sering" class="peer sr-only">
                                    <div class="flex flex-col p-4 border border-gray-200 rounded-xl transition-all hover:bg-gray-50 h-full">
                                        <div class="flex items-center gap-2 mb-1">
                                            <div class="radio-indicator w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center"></div>
                                            <span class="font-medium text-gray-800 text-sm">Sering</span>
                                        </div>
                                        <span class="text-xs text-gray-500">Setiap hari / ≥1 porsi manis harian</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-semibold py-4 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-lg shadow-brand-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                Jalankan Evaluasi Risiko & Klasifikasi AI
                            </button>
                        </div>

                        <!-- DISCLAIMER -->
                        <div class="bg-gray-50 rounded-xl p-4 flex gap-3 text-sm text-gray-500">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p><strong class="text-gray-700">Disclaimer Medis Resmi:</strong> Hasil kalkulasi ini merupakan estimasi stratifikasi risiko awal berbasis algoritma dan statistik populasi. Hasil ini bukan diagnosis klinis definitif. Untuk tes HbA1c atau Gula Darah Puasa (GDP), hubungi fasilitas layanan kesehatan terdekat.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection