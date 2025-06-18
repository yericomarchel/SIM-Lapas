<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan Kunjungan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Informasi Kunjungan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div><strong>Nama Pengunjung:</strong><br>{{ $kunjungan->user->name }}</div>
                        <div><strong>Warga Binaan Tujuan:</strong><br>{{ $kunjungan->wargaBinaan->nama_lengkap }}</div>
                        <div><strong>Tanggal Kunjungan:</strong><br>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}</div>
                        <div><strong>Sesi Kunjungan:</strong><br>{{ $kunjungan->sesi_kunjungan }}</div>
                        <div class="col-span-2"><strong>Nama Pengikut:</strong><br>{{ $kunjungan->nama_pengikut ?? '-' }}</div>
                        <div class="col-span-2">
                            <strong>Foto KTP Penanggung Jawab:</strong><br>
                            <img src="{{ asset('storage/' . $kunjungan->path_ktp) }}" alt="Foto KTP" class="mt-2 border rounded-md max-w-sm">
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        {{-- Form untuk Approve --}}
                        <form action="{{ route('admin.verifikasi.approve', $kunjungan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <x-primary-button class="bg-green-600 hover:bg-green-800">
                                Setujui
                            </x-primary-button>
                        </form>
                         {{-- Form untuk Reject --}}
                        <form action="{{ route('admin.verifikasi.reject', $kunjungan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <x-danger-button>
                                Tolak
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
