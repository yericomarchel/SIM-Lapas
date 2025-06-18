<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Pengajuan Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('kunjungan.store') }}" method="POST" enctype="multipart/form-data"
                          x-data="{ isSubmitting: false }"
                          x-on:submit="isSubmitting = true">
                        @csrf

                        {{-- Input Warga Binaan, Tanggal, Sesi (Tidak Berubah) --}}
                        <div class="mb-4">
                            <label for="warga_binaan_id" class="block text-sm font-medium text-gray-700">Nama Warga Binaan yang Dituju</label>
                            <select name="warga_binaan_id" id="warga_binaan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">-- Pilih Salah Satu --</option>
                                @foreach ($wargaBinaan as $wbp)
                                    <option value="{{ $wbp->id }}" {{ old('warga_binaan_id') == $wbp->id ? 'selected' : '' }}>
                                        {{ $wbp->nama_lengkap }} (No. Reg: {{ $wbp->nomor_registrasi }})
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_binaan_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                            <input type="text" name="tanggal_kunjungan" id="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}" class="datepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Pilih tanggal...">
                            @error('tanggal_kunjungan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="sesi_kunjungan" class="block text-sm font-medium text-gray-700">Sesi Kunjungan</label>
                            <select name="sesi_kunjungan" id="sesi_kunjungan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Sesi Pagi (09:00 - 11:00)" {{ old('sesi_kunjungan') == 'Sesi Pagi (09:00 - 11:00)' ? 'selected' : '' }}>Sesi Pagi (09:00 - 11:00)</option>
                                <option value="Sesi Siang (14:00 - 15:00)" {{ old('sesi_kunjungan') == 'Sesi Siang (14:00 - 15:00)' ? 'selected' : '' }}>Sesi Siang (14:00 - 15:00)</option>
                            </select>
                            @error('sesi_kunjungan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- =============================================== --}}
                        {{-- === BAGIAN NAMA PENGIKUT YANG KITA UBAH TOTAL === --}}
                        {{-- =============================================== --}}
                        <div class="mb-4" x-data="{ followers: {{ json_encode(old('nama_pengikut', [''])) }} }">
                            <label class="block text-sm font-medium text-gray-700">Nama Pengikut (jika ada)</label>

                            <template x-for="(follower, index) in followers" :key="index">
                                <div class="flex items-center space-x-2 mt-2">
                                    <span x-text="index + 1 + '.'" class="text-gray-500"></span>
                                    <input type="text" name="nama_pengikut[]" x-model="followers[index]" class="flex-grow mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Masukkan nama pengikut">
                                    <button type="button" x-on:click="followers.splice(index, 1)" x-show="followers.length > 1" class="text-red-500 hover:text-red-700">
                                        Hapus
                                    </button>
                                </div>
                            </template>

                            <button type="button" x-on:click="followers.push('')" class="mt-2 text-sm text-blue-600 hover:underline">
                                + Tambah Pengikut Lain
                            </button>
                            @error('nama_pengikut.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Upload KTP (Tidak Berubah) --}}
                        <div class="mb-4">
                            <label for="path_ktp" class="block text-sm font-medium text-gray-700">Upload Foto KTP (JPG, PNG, maks 2MB)</label>
                            <input type="file" name="path_ktp" id="path_ktp" class="mt-1 block w-full">
                            @error('path_ktp')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mt-6">
                            <x-primary-button ::disabled="isSubmitting">
                                <span x-show="!isSubmitting">Kirim Pengajuan</span>
                                <span x-show="isSubmitting">Memproses...</span>
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Script Flatpickr (Tidak Berubah)
            flatpickr(".datepicker", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6);
                    },
                    ...{{ Js::from($hariLibur) }}
                ],
            });
        </script>
    @endpush
</x-app-layout>
