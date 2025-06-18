<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kamar Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.kamar.store') }}" method="POST"
                          x-data="{ isSubmitting: false }"
                          x-on:submit="isSubmitting = true">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_kamar" class="block text-sm font-medium text-gray-700">Nama Kamar <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_kamar" id="nama_kamar" value="{{ old('nama_kamar') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nama_kamar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="blok" class="block text-sm font-medium text-gray-700">Blok <span class="text-red-500">*</span></label>
                            <input type="text" name="blok" id="blok" value="{{ old('blok') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('blok')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas <span class="text-red-500">*</span></label>
                            <input type="number" name="kapasitas" id="kapasitas" value="{{ old('kapasitas', 0) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('kapasitas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center space-x-4">
                            <x-primary-button ::disabled="isSubmitting">
                                <span x-show="!isSubmitting">Simpan</span>
                                <span x-show="isSubmitting">Menyimpan...</span>
                            </x-primary-button>
                            <a href="{{ route('admin.kamar.index') }}" class="text-gray-600 hover:underline">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
