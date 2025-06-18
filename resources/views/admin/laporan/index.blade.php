<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Kunjungan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Form Filter --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Filter Laporan</h3>
                    <form action="{{ route('admin.laporan.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div>
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ request('tanggal_selesai') }}">
                            </div>
                            <div class="self-end">
                                <x-primary-button>
                                    Tampilkan Laporan
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Hasil Laporan --}}
            @if ($kunjunganData)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-lg">Hasil Laporan untuk Periode {{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') }} s/d {{ \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d M Y') }}</h3>
                            <a href="{{ route('admin.laporan.export', request()->all()) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Export ke PDF
                            </a>
                        </div>

                        {{-- Statistik --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 text-center">
                            <div class="p-4 bg-blue-100 rounded-lg"><div class="text-2xl font-bold">{{ $stats['total'] }}</div><div>Total Pengajuan</div></div>
                            <div class="p-4 bg-green-100 rounded-lg"><div class="text-2xl font-bold">{{ $stats['disetujui'] }}</div><div>Disetujui</div></div>
                            <div class="p-4 bg-red-100 rounded-lg"><div class="text-2xl font-bold">{{ $stats['ditolak'] }}</div><div>Ditolak</div></div>
                            <div class="p-4 bg-yellow-100 rounded-lg"><div class="text-2xl font-bold">{{ $stats['menunggu'] }}</div><div>Menunggu</div></div>
                        </div>

                        {{-- Tabel Detail --}}
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- ... (header tabel seperti di halaman verifikasi) ... --}}
                            <tbody>
                                @forelse ($kunjunganData as $kunjungan)
                                    <tr>
                                        <td class="px-6 py-4">{{ $kunjungan->user->name }}</td>
                                        <td class="px-6 py-4">{{ $kunjungan->wargaBinaan->nama_lengkap }}</td>
                                        <td class="px-6 py-4">{{ $kunjungan->status }}</td>
                                        <td class="px-6 py-4">{{ $kunjungan->approver->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center py-4">Tidak ada data pada periode ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
