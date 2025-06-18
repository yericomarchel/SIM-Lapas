<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Pengajuan Baru</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $jumlahPengajuanBaru }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Kunjungan Hari Ini</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $kunjunganDisetujuiHariIni }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Total Warga Binaan Aktif</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalWargaBinaan }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">5 Pengajuan Kunjungan Terbaru (Menunggu Persetujuan)</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($pengajuanTerbaru as $pengajuan)
                                            <tr>
                                                <td class="px-2 py-3">
                                                    <p class="font-medium text-gray-900">{{ $pengajuan->user->name }}</p>
                                                    <p class="text-sm text-gray-500">ingin mengunjungi {{ $pengajuan->wargaBinaan->nama_lengkap }}</p>
                                                </td>
                                                <td class="px-2 py-3 text-right">
                                                    <a href="{{ route('admin.verifikasi.show', $pengajuan->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat & Verifikasi</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td class="py-4 text-center text-gray-500">Tidak ada pengajuan baru.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Jadwal Kunjungan Disetujui Hari Ini</h3>
                            <div class="overflow-x-auto">
                                <ul class="divide-y divide-gray-200">
                                     @forelse ($jadwalHariIni as $jadwal)
                                        <li class="py-3 flex justify-between items-center">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $jadwal->user->name }}</p>
                                                <p class="text-sm text-gray-500">mengunjungi {{ $jadwal->wargaBinaan->nama_lengkap }} (Sesi: {{ $jadwal->sesi_kunjungan }})</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="py-4 text-center text-gray-500">Tidak ada jadwal kunjungan hari ini.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Akses Cepat</h3>
                        <nav class="flex flex-col space-y-1">
                            {{-- Menu 1: Verifikasi Kunjungan --}}
                            <a href="{{ route('admin.verifikasi.index') }}" class="flex items-center w-full p-3 rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition ease-in-out duration-150">
                                <svg class="w-6 h-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span class="font-medium">Verifikasi Kunjungan</span>
                            </a>
                            {{-- Menu 2: Kelola Warga Binaan --}}
                            <a href="{{ route('admin.warga-binaan.index') }}" class="flex items-center w-full p-3 rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition ease-in-out duration-150">
                                <svg class="w-6 h-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962a3.75 3.75 0 015.25 0m-5.25 0a3.75 3.75 0 00-5.25 0M3 13.5g7.5-7.5 7.5 7.5m-7.5-7.5v7.5" /></svg>
                                <span class="font-medium">Kelola Warga Binaan</span>
                            </a>
                            {{-- Menu 3: Kelola Hari Libur --}}
                            <a href="{{ route('admin.hari-libur.index') }}" class="flex items-center w-full p-3 rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition ease-in-out duration-150">
                                <svg class="w-6 h-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008z" /></svg>
                                <span class="font-medium">Kelola Hari Libur</span>
                            </a>
                            <a href="{{ route('admin.kamar.index') }}" class="flex items-center w-full p-3 rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                <svg class="w-6 h-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" /></svg>
                                <span class="font-medium">Kelola Kamar & Blok</span>
                            </a>
                            {{-- Menu 4: Laporan Kunjungan --}}
                            <a href="{{ route('admin.laporan.index') }}" class="flex items-center w-full p-3 rounded-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition ease-in-out duration-150">
                                <svg class="w-6 h-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 100 15 7.5 7.5 0 000-15zM21 21l-5.197-5.197" /></svg>
                                <span class="font-medium">Laporan Kunjungan</span>
                            </a>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
