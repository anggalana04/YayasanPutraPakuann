@extends('layouts.SMK.ppdb')

@section('title', 'Login PPDB')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Masuk ke Sistem PPDB
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Masukkan ID Pendaftaran dan Tanggal Lahir Anda
            </p>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('ppdb.login', ['school' => $school ?? 'SMK']) }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="application_id" class="sr-only">ID Pendaftaran</label>
                    <input id="application_id" name="application_id" type="text" autocomplete="off" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="ID Pendaftaran (contoh: PPDB-2024-001)">
                </div>
                <div>
                    <label for="date_of_birth" class="sr-only">Tanggal Lahir</label>
                    <input id="date_of_birth" name="date_of_birth" type="date" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                </div>
            </div>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terjadi kesalahan:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Masuk
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('ppdb.register', ['school' => $school ?? 'SMK']) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Belum punya akun? Daftar di sini
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
