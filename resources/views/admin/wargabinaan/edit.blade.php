<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Warga Binaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.warga-binaan.update', $warga_binaan->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk method update, gunakan PUT --}}

                        <div class="mb-4">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $warga_binaan->nama_lengkap) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="nomor_registrasi">Nomor Registrasi</label>
                            <input type="text" name="nomor_registrasi" id="nomor_registrasi" value="{{ old('nomor_registrasi', $warga_binaan->nomor_registrasi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="kamar_id" class="block text-sm font-medium text-gray-700">Kamar / Sel</label>
                            <select name="kamar_id" id="kamar_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">-- Pilih Kamar --</option>
                                @foreach ($kamar as $item)
                                    <option value="{{ $item->id }}" {{ old('kamar_id', $warga_binaan->kamar_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kamar }} (Blok: {{ $item->blok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kamar_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Aktif" @selected($warga_binaan->status == 'Aktif')>Aktif</option>
                                <option value="Tidak Aktif" @selected($warga_binaan->status == 'Tidak Aktif')>Tidak Aktif</option>
                            </select>
                        </div>
                        <div>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
