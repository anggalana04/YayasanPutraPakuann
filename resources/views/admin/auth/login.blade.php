@extends('admin.layouts.app')

@section('content')
<main class="min-h-screen flex items-center justify-center p-4 md:p-8 bg-background">
    <div class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-2 bg-white rounded-xl overflow-hidden shadow-xl min-h-[480px]">
        <!-- Left: Branding -->
        <div class="hidden md:flex flex-col justify-center items-center bg-primary-container p-8">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl" data-icon="admin_panel_settings">admin_panel_settings</span>
                </div>
                <h2 class="text-2xl font-extrabold tracking-tighter text-primary mb-2">Admin Panel</h2>
                <p class="text-sm text-primary-dim text-center">Yayasan Putra Pakuan</p>
            </div>
        </div>
        <!-- Right: Login Form -->
        <div class="flex flex-col justify-center px-8 py-12 md:px-10 bg-white">
            <div class="max-w-md mx-auto w-full">
                <header class="mb-8 text-center">
                    <h2 class="text-2xl font-bold text-charcoal mb-2 tracking-tight">Login Admin</h2>
                    <p class="text-on-surface-variant text-sm">Masuk ke dashboard admin Anda</p>
                </header>
                @if($errors->any())
                    <div class="mb-4 text-red-600 text-sm text-center">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
                    @csrf
                    <div class="space-y-2 group">
                        <label class="text-sm font-bold text-charcoal block ml-1" for="email">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline text-xl" data-icon="person">person</span>
                            </div>
                            <input class="block w-full pl-11 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-0 rounded-t-xl transition-all font-medium text-charcoal placeholder:text-outline-variant" id="email" name="email" placeholder="admin@email.com" type="email" required autofocus value="{{ old('email') }}" />
                        </div>
                    </div>
                    <div class="space-y-2 group">
                        <div class="flex justify-between items-center ml-1">
                            <label class="text-sm font-bold text-charcoal" for="password">Kata Sandi</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline text-xl" data-icon="lock">lock</span>
                            </div>
                            <input class="block w-full pl-11 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-0 rounded-t-xl transition-all font-medium text-charcoal placeholder:text-outline-variant" id="password" name="password" placeholder="••••••••••••" type="password" required />
                        </div>
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-600">Remember Me</label>
                    </div>
                    <button type="submit" class="w-full bg-primary-container text-on-primary-fixed font-bold py-4 px-6 rounded-xl shadow-lg shadow-primary-container/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group">
                        <span>Masuk ke Dashboard</span>
                        <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
