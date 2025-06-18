<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Hari Libur') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Form Tambah Hari Libur --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('admin.hari-libur.store') }}" method="POST">
                    @csrf
                    <h3 class="text-lg font-medium text-gray-900">Tambah Hari Libur Baru</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('tanggal')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('keterangan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="self-end">
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Daftar Hari Libur --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Hari Libur</h3>
                 @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <table class="min-w-full divide-y divide-gray-200">
                    <thead><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th><th></th></tr></thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($hariLibur as $libur)
                        <tr>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($libur->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td class="px-6 py-4">{{ $libur->keterangan }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.hari-libur.destroy', $libur->id) }}" method="POST" onsubmit="return confirm('Yakin hapus tanggal ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4">Belum ada data hari libur.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                 <div class="mt-4">{{ $hariLibur->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
