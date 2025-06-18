<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <aside
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0"
            :class="{'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen}"
        >
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="text-white text-2xl mx-2 font-semibold">Admin Panel</span>
                </div>
            </div>

            <nav class="mt-10">
                {{-- Gunakan komponen admin-nav-link yang baru kita buat --}}
                <x-admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <span class="mx-3">Dashboard</span>
                </x-admin-nav-link>

                <x-admin-nav-link :href="route('admin.verifikasi.index')" :active="request()->routeIs('admin.verifikasi.*')" class="mt-4">
                    <span class="mx-3">Verifikasi Kunjungan</span>
                </x-admin-nav-link>

                <p class="px-4 mt-6 mb-2 text-xs text-gray-500 uppercase">Master Data</p>

                <x-admin-nav-link :href="route('admin.warga-binaan.index')" :active="request()->routeIs('admin.warga-binaan.*')">
                    <span class="mx-3">Warga Binaan</span>
                </x-admin-nav-link>

                <x-admin-nav-link :href="route('admin.hari-libur.index')" :active="request()->routeIs('admin.hari-libur.*')" class="mt-4">
                    <span class="mx-3">Hari Libur</span>
                </x-admin-nav-link>

                <p class="px-4 mt-6 mb-2 text-xs text-gray-500 uppercase">Lainnya</p>

                <x-admin-nav-link :href="route('admin.laporan.index')" :active="request()->routeIs('admin.laporan.*')">
                    <span class="mx-3">Laporan</span>
                </x-admin-nav-link>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center px-4 py-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-gray-100">
                        <span class="mx-3">Logout</span>
                    </a>
                </form>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 1
