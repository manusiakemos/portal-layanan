@php
    use App\Models\KategoriLayanan;
    $katalog = KategoriLayanan::latest()->take(2)->get();
@endphp

<div class="relative flex flex-col gap-4 pb-20">
    <div class="flex justify-between items-center w-full">
        <x-heading :border="false" label="Katalog Layanan E-Gov"/>
        <x-button-link
            icon="heroicon-o-arrow-right"
            href="{{ route('katalog') }}"
            label="Lihat Semua"/>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($katalog as $item)
            <div class="p-4 bg-white shadow rounded-lg flex flex-col justify-between">
                <div>
                    <h3 class="font-semibold text-base text-primary-700 mb-1">{{ $item->category }} - {{ $item->name }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($item->deskripsi_kategori, 60) }}</p>
                </div>                
            </div>
        @empty
            <p class="text-gray-500">Belum ada dokumen.</p>
        @endforelse
    </div>
</div>