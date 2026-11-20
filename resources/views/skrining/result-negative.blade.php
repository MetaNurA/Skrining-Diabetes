@extends('layouts.app')

@section('title', 'Hasil Evaluasi Risiko - DiaCare')

@section('content')
<main class="w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="max-w-5xl mx-auto">
        <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <p class="text-sm font-semibold text-brand-600">DiaCare · Clinical AI</p>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1">Hasil Skrining Diabetes</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('skrining.create') }}" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Skrining Ulang</a>
                <button type="button" onclick="openModal()" class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Unduh PDF
                </button>
            </div>
        </header>

        <section class="rounded-2xl border border-green-200 bg-white p-5 sm:p-8 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <div class="min-w-0 flex-1">
                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-800">{{ $hasil_ai['kategori'] }}</span>
                    <h2 class="mt-4 text-xl sm:text-2xl font-bold text-gray-900">Hasil skrining menunjukkan risiko rendah</h2>
                    <p class="mt-2 text-gray-600">{{ $hasil_ai['status_model'] }} Hasil ini merupakan skrining awal, bukan diagnosis medis.</p>
                    <p class="mt-4 text-sm text-gray-500">ID evaluasi: <strong class="text-gray-800">{{ $hasil_ai['id_evaluasi'] }}</strong> · {{ $hasil_ai['waktu'] }}</p>
                </div>
                <div class="shrink-0 rounded-2xl bg-green-50 px-8 py-6 text-center">
                    <p class="text-sm text-green-800">Skor risiko</p>
                    <p class="text-4xl font-extrabold text-green-700">{{ $hasil_ai['skor_risiko'] }}%</p>
                    <p class="mt-1 text-xs text-gray-600">Confidence {{ $hasil_ai['confidence'] }}</p>
                </div>
            </div>
        </section>

        <section class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="rounded-xl border border-gray-200 bg-white p-4"><p class="text-xs text-gray-500">Usia</p><p class="mt-1 font-semibold text-gray-900">{{ $hasil_ai['usia'] }} tahun</p></div>
            <div class="rounded-xl border border-gray-200 bg-white p-4"><p class="text-xs text-gray-500">Indeks Massa Tubuh</p><p class="mt-1 font-semibold text-gray-900">{{ $hasil_ai['bmi'] }} kg/m² · {{ $hasil_ai['kategori_bmi'] }}</p><p class="text-xs text-gray-500">TB {{ $hasil_ai['tinggi'] }} cm · BB {{ $hasil_ai['berat'] }} kg</p></div>
            <div class="rounded-xl border border-gray-200 bg-white p-4"><p class="text-xs text-gray-500">Tekanan darah</p><p class="mt-1 font-semibold text-gray-900">{{ $hasil_ai['tekanan_darah'] }}</p></div>
            <div class="rounded-xl border border-gray-200 bg-white p-4"><p class="text-xs text-gray-500">Aktivitas fisik</p><p class="mt-1 font-semibold text-gray-900">{{ ucfirst($hasil_ai['aktivitas']) }}</p></div>
        </section>

        <section class="mt-6 rounded-2xl border border-brand-100 bg-brand-50/60 p-5 sm:p-6">
            <h2 class="font-bold text-gray-900">Pertahankan kebiasaan sehat</h2>
            <p class="mt-2 text-sm leading-relaxed text-gray-700">Pertahankan aktivitas fisik teratur, pola makan seimbang, dan batasi konsumsi makanan serta minuman tinggi gula. Pertimbangkan pemeriksaan berkala atau konsultasi tenaga kesehatan bila memiliki keluhan maupun faktor risiko.</p>
        </section>

        <p class="mt-6 rounded-xl bg-gray-100 p-4 text-xs leading-relaxed text-gray-600"><strong class="text-gray-800">Penafian medis:</strong> Hasil skrining berbasis model ini hanya untuk edukasi dan stratifikasi risiko awal; bukan diagnosis dan tidak menggantikan konsultasi tenaga kesehatan.</p>
    </div>
</main>

@include('skrining.partials.pdf-modal')
@endsection
