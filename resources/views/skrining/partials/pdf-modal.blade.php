<div id="modalPdf" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4 py-6" aria-hidden="true">
    <div class="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] shadow-2xl overflow-y-auto" id="modalPdfContent" role="dialog" aria-modal="true" aria-labelledby="modalPdfTitle">
        <div class="p-5 sm:p-6 border-b border-gray-100 flex justify-between items-start gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-12 h-12 shrink-0 bg-brand-50 rounded-xl flex items-center justify-center text-brand-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2-2z"></path></svg>
                </div>
                <div class="min-w-0">
                    <h3 id="modalPdfTitle" class="text-lg sm:text-xl font-bold text-gray-900">Unduh Rekapitulasi Hasil Skrining (PDF)</h3>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 break-words">ID Evaluasi: <span class="font-medium text-brand-600">{{ $hasil_ai['id_evaluasi'] }}</span> · Laporan Skrining DiaCare</p>
                </div>
            </div>
            <button type="button" data-close-pdf-modal class="shrink-0 text-gray-500 hover:text-gray-800 bg-gray-50 hover:bg-gray-100 p-2 rounded-full" aria-label="Tutup modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-5 sm:p-6 bg-gray-50/70">
            <div class="bg-white rounded-2xl p-4 sm:p-5 mb-6 border border-gray-200 shadow-sm">
                <div class="flex flex-wrap justify-between items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                    <span class="text-brand-600 font-bold">DiaCare <span class="text-[10px] bg-brand-50 px-1.5 py-0.5 rounded">CLINICAL AI</span></span>
                    <span class="text-[10px] text-gray-500">Laporan mandiri · {{ $hasil_ai['waktu'] }}</span>
                </div>
                <p class="text-xs text-gray-500 mb-1">HASIL SKRINING</p>
                <div class="flex flex-wrap justify-between items-center gap-3">
                    <div>
                        <p class="text-base font-bold text-gray-900">{{ $hasil_ai['kategori'] }}</p>
                        <p class="text-xs text-gray-600">{{ $hasil_ai['kategori'] === 'Risiko Tinggi' ? 'Disarankan berkonsultasi dengan tenaga kesehatan untuk evaluasi lebih lanjut.' : 'Pertahankan pola hidup sehat dan lakukan skrining berkala.' }}</p>
                    </div>
                    <p class="text-2xl font-bold text-brand-600">{{ $hasil_ai['skor_risiko'] }}%</p>
                </div>
                <div class="mt-4 pt-3 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-gray-600">
                    <span>Usia: {{ $hasil_ai['usia'] }} tahun</span>
                    <span>BMI: {{ $hasil_ai['bmi'] }} kg/m²</span>
                    <span>Tekanan darah: {{ $hasil_ai['tekanan_darah'] }}</span>
                    <span>Kepercayaan model: {{ $hasil_ai['confidence'] }}</span>
                </div>
            </div>
            <h4 class="font-bold text-gray-900 mb-3">Konten laporan</h4>
            <div class="space-y-3 text-sm">
                <div class="bg-white border border-gray-100 rounded-xl p-3">Ringkasan hasil dan parameter skrining Anda.</div>
                <div class="bg-white border border-gray-100 rounded-xl p-3">Rekomendasi tindak lanjut sesuai kategori hasil.</div>
                <div class="bg-white border border-gray-100 rounded-xl p-3">Penafian: hasil skrining bukan diagnosis medis.</div>
            </div>
        </div>
        <div class="p-5 sm:p-6 border-t border-gray-100 bg-white flex flex-col-reverse sm:flex-row sm:justify-between gap-3">
            <button type="button" data-close-pdf-modal class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50">Batal</button>
            <button type="button" onclick="downloadPdf()" class="w-full sm:w-auto bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl inline-flex items-center justify-center gap-2 transition-colors shadow-lg shadow-brand-500/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Unduh Dokumen PDF (.pdf)
            </button>
        </div>
    </div>
</div>
<iframe id="download_iframe" title="Unduhan PDF" style="display:none"></iframe>

@push('styles')
<style>
    @media print {
        body * { visibility: hidden !important; }
        #modalPdf, #modalPdf * { visibility: visible !important; }
        #modalPdf { position: static !important; display: block !important; padding: 0 !important; background: #fff !important; }
        #modalPdfContent { max-width: none !important; max-height: none !important; overflow: visible !important; box-shadow: none !important; border-radius: 0 !important; }
        #modalPdfContent button { display: none !important; }
    }
</style>
@endpush

@php
    $pdfUrl = route('skrining.pdf', [
        'id_evaluasi' => $hasil_ai['id_evaluasi'],
        'waktu' => $hasil_ai['waktu'],
        'kategori' => $hasil_ai['kategori'],
        'skor_risiko' => $hasil_ai['skor_risiko'],
        'usia' => $hasil_ai['usia'],
        'bmi' => $hasil_ai['bmi'],
        'tekanan_darah' => $hasil_ai['tekanan_darah'],
        'riwayat_diabetes' => $hasil_ai['riwayat_diabetes'],
        'confidence' => $hasil_ai['confidence'],
        'aktivitas' => $hasil_ai['aktivitas'],
        'konsumsi' => $hasil_ai['konsumsi'],
    ]);
@endphp

@push('scripts')
<script>
(() => {
    const modal = document.getElementById('modalPdf');
    if (!modal) return;
    const openModal = () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');
    };
    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
    };
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.downloadPdf = () => {
        const iframe = document.getElementById('download_iframe');
        if (iframe) iframe.src = @json($pdfUrl);
    };
    document.querySelectorAll('[data-open-pdf-modal]').forEach(button => button.addEventListener('click', openModal));
    modal.querySelectorAll('[data-close-pdf-modal]').forEach(button => button.addEventListener('click', closeModal));
    modal.addEventListener('click', event => { if (event.target === modal) closeModal(); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });
})();
</script>
@endpush
