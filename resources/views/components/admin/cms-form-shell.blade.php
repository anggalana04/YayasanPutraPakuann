@props([
    'title',
    'eyebrow' => null,
    'subtitle' => null,
    'backUrl' => null,
    'backLabel' => 'Kembali',
    'width' => 'max-w-4xl',
])

<div {{ $attributes->class(['mx-auto space-y-6', $width]) }}>
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div class="space-y-2">
            @if ($eyebrow)
                <p class="text-xs font-bold uppercase tracking-[0.28em] text-primary">{{ $eyebrow }}</p>
            @endif
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-[#1c190d]">{{ $title }}</h2>
                @if ($subtitle)
                    <p class="mt-1 text-sm text-on-surface-variant">{{ $subtitle }}</p>
                @endif
            </div>
        </div>

        @if ($backUrl)
            <a href="{{ $backUrl }}"
               data-admin-nav
               class="inline-flex items-center justify-center gap-2 rounded-2xl border border-primary/20 bg-white px-5 py-3 text-sm font-bold text-primary shadow-sm transition-all hover:bg-primary/10">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>{{ $backLabel }}</span>
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-bold text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <ul class="ml-5 list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-[28px] border border-[#1c190d]/6 bg-surface-container-lowest p-6 shadow-sm ring-1 ring-[#1c190d]/5 md:p-8">
        {{ $slot }}
    </div>
</div>
