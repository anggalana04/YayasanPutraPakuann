{{-- ============================================================
     SCHOOL HOMEPAGE PARTIAL  (redesigned v2)
     $schoolConfig, $homepage, $latestNews, $latestGallery,
     $ppdbLive, $ppdbCountdownDate, $ppdbCurrentPhase, $ppdbPeriod, $school
============================================================ --}}
@php $ppdbIsLive = $ppdbLive ?? false; $ppdbYear = $ppdbPeriod ?? (date('Y').'/'.((int)date('Y')+1)); @endphp

{{-- =========================================================
     1. SPMB ANNOUNCEMENT
========================================================= --}}
@if ($ppdbIsLive)
{{-- ===== SPMB LIVE ===== --}}
<section style="background: #08080f; overflow: hidden;">

    {{-- Top status strip --}}
    <div style="border-bottom: 1px solid rgba(255,255,255,0.07); padding: 13px 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
            <div class="flex items-center gap-2">
                <span class="relative flex h-2 w-2 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
            </div>
            <span style="color: rgba(255,255,255,0.78); font-size: 12px; font-weight: 500;">Tahun Ajaran {{ $ppdbYear }}</span>
        </div>
    </div>

    {{-- Main split layout --}}
    <div style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem 4.5rem;">
        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-14">

            {{-- ── LEFT: Text content ── --}}
            <div class="flex-1 min-w-0">

                {{-- Eyebrow --}}
                <div class="flex items-center gap-3" style="margin-bottom: 1.5rem;">
                    <div style="width: 36px; height: 2px; background: #FDB913; border-radius: 2px; flex-shrink: 0;"></div>
                    <span style="color: #FDB913; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.25em;">Penerimaan Peserta Didik Baru</span>
                </div>

                {{-- Big headline --}}
                <h2 style="font-size: clamp(2.8rem, 6vw, 5.2rem); font-weight: 900; color: #ffffff; line-height: 0.9; letter-spacing: -0.03em; margin: 0 0 1.25rem 0;">
                    SPMB<br>
                    <span style="color: #FDB913;">{{ $schoolConfig['short_name'] }}</span><br>
                    Putra Pakuan
                </h2>

                {{-- Year tag --}}
                <p style="color: rgba(255,255,255,0.78); font-size: 14px; font-weight: 500; margin: 0 0 1.25rem 0;">
                    Tahun Ajaran {{ $ppdbYear }}
                </p>

                {{-- Description --}}
                <p style="color: rgba(255,255,255,0.88); font-size: 15px; line-height: 1.65; max-width: 440px; margin: 0 0 2rem 0;">
                    Bergabunglah dengan {{ $schoolConfig['name'] }} dan raih masa depanmu bersama kami.
                    Fasilitas lengkap, pengajar berpengalaman, dan kurikulum industri terkini.
                </p>

                {{-- Phase badge --}}
                @if ($ppdbCurrentPhase)
                <div style="display: inline-flex; align-items: center; gap: 10px; background: rgba(253,185,19,0.12); border: 1px solid rgba(253,185,19,0.35); border-radius: 9999px; padding: 8px 20px; margin-bottom: 2rem;">
                    <span style="width: 7px; height: 7px; background: #FDB913; border-radius: 50%; flex-shrink: 0;"></span>
                    <span style="color: #FDB913; font-size: 13px; font-weight: 600;">{{ $ppdbCurrentPhase }}</span>
                    <span style="color: rgba(255,255,255,0.78); font-size: 11px;">· Sedang Berjalan</span>
                </div>
                @endif

                {{-- CTA row --}}
                <div class="flex flex-wrap items-center gap-5">
                    <a href="{{ route('school.ppdb', ['school' => $school]) }}"
                       style="display: inline-flex; align-items: center; gap: 9px; background: #FDB913; color: #0a0a0a; font-weight: 800; font-size: 14px; padding: 14px 30px; border-radius: 12px; text-decoration: none; transition: opacity 0.15s;"
                       onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <span class="material-symbols-outlined" style="font-size: 18px; line-height: 1;">how_to_reg</span>
                        Daftar Sekarang
                    </a>
                    @if ($ppdbCountdownDate)
                    <div>
                        <div style="color: rgba(255,255,255,0.82); font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 600; margin-bottom: 4px;">Batas Pendaftaran</div>
                        <div style="color: #ffffff; font-weight: 700; font-size: 15px;">{{ \Carbon\Carbon::parse($ppdbCountdownDate)->isoFormat('D MMMM YYYY') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- ── RIGHT: Countdown ── --}}
            @if ($ppdbCountdownDate)
            <div class="w-full lg:w-auto shrink-0" style="min-width: 300px; max-width: 360px;">
                <div style="color: rgba(255,255,255,0.82); font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.25em; margin-bottom: 18px;">Waktu Tersisa</div>

                <div id="ppdb-countdown" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;"
                     data-target="{{ \Carbon\Carbon::parse($ppdbCountdownDate)->endOfDay()->toIso8601String() }}">

                    <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 26px 14px; text-align: center;">
                        <div id="ppdb-days" style="font-size: 3rem; font-weight: 900; color: #ffffff; font-variant-numeric: tabular-nums; line-height: 1; letter-spacing: -0.03em;">00</div>
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.18em; color: rgba(255,255,255,0.75); margin-top: 10px; font-weight: 600;">Hari</div>
                    </div>

                    <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 26px 14px; text-align: center;">
                        <div id="ppdb-hours" style="font-size: 3rem; font-weight: 900; color: #ffffff; font-variant-numeric: tabular-nums; line-height: 1; letter-spacing: -0.03em;">00</div>
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.18em; color: rgba(255,255,255,0.75); margin-top: 10px; font-weight: 600;">Jam</div>
                    </div>

                    <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 26px 14px; text-align: center;">
                        <div id="ppdb-minutes" style="font-size: 3rem; font-weight: 900; color: #ffffff; font-variant-numeric: tabular-nums; line-height: 1; letter-spacing: -0.03em;">00</div>
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.18em; color: rgba(255,255,255,0.75); margin-top: 10px; font-weight: 600;">Menit</div>
                    </div>

                    <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 26px 14px; text-align: center;">
                        <div id="ppdb-seconds" style="font-size: 3rem; font-weight: 900; color: #ffffff; font-variant-numeric: tabular-nums; line-height: 1; letter-spacing: -0.03em;">00</div>
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.18em; color: rgba(255,255,255,0.75); margin-top: 10px; font-weight: 600;">Detik</div>
                    </div>
                </div>

                <p style="color: rgba(255,255,255,0.68); font-size: 11px; line-height: 1.6; margin-top: 14px;">
                    Waktu tersisa hingga penutupan fase pendaftaran. Segera lengkapi dokumen Anda.
                </p>
            </div>
            @else
            <div class="w-full lg:w-64 shrink-0" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 32px; gap: 14px; background: rgba(255,255,255,0.03); border-radius: 20px; border: 1px solid rgba(255,255,255,0.07);">
                <span class="material-symbols-outlined" style="font-size: 52px; color: #FDB913;">how_to_reg</span>
                <p style="color: rgba(255,255,255,0.5); font-size: 13px; text-align: center; line-height: 1.55; margin: 0;">Kuota terbatas. Segera daftarkan diri Anda sebelum habis.</p>
            </div>
            @endif

        </div>
    </div>

    {{-- Bottom bar --}}
    <div style="border-top: 1px solid rgba(255,255,255,0.06); padding: 14px 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 6px;">
            <span style="color: rgba(255,255,255,0.65); font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em;">{{ $schoolConfig['name'] }}</span>
            <span style="color: rgba(255,255,255,0.50); font-size: 11px;">© Putra Pakuan Education Group</span>
        </div>
    </div>
</section>

@else
{{-- ===== SPMB CLOSED ===== --}}
<section style="background: #f5f4ef; padding: 3.5rem 1.5rem;">
    <div style="max-width: 860px; margin: 0 auto;">

        {{-- Label pill --}}
        <div style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #fff; border: 1px solid #e4dfc8; border-radius: 9999px; padding: 6px 16px;">
                <span class="material-symbols-outlined" style="font-size: 13px; color: #b45309;">notifications</span>
                <span style="font-size: 11px; font-weight: 700; color: #92400e; text-transform: uppercase; letter-spacing: 0.18em;">Pengumuman SPMB</span>
            </div>
        </div>

        {{-- Main card --}}
        <div style="background: #ffffff; border-radius: 20px; border: 1px solid #e8e3d4; box-shadow: 0 2px 8px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.04); overflow: hidden;">
            <div style="display: flex; align-items: stretch;">

                {{-- Left accent strip --}}
                <div style="width: 5px; flex-shrink: 0; background: linear-gradient(180deg, #FDB913 0%, #f59e0b 100%);"></div>

                {{-- Content --}}
                <div style="flex: 1; padding: 28px 28px 28px 24px; display: flex; flex-wrap: wrap; align-items: center; gap: 20px;">

                    {{-- Icon --}}
                    <div style="width: 54px; height: 54px; background: #fffbeb; border-radius: 14px; border: 1px solid #fde68a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <span class="material-symbols-outlined" style="font-size: 26px; color: #d97706;">campaign</span>
                    </div>

                    {{-- Text --}}
                    <div style="flex: 1; min-width: 180px;">
                        <p style="font-weight: 700; color: #1a1814; font-size: 15px; margin: 0 0 6px 0;">{{ $schoolConfig['name'] }}</p>
                        <p style="color: #6b6759; font-size: 13px; margin: 0; line-height: 1.6;">
                            {{ $schoolConfig['ppdb_offline_text'] ?? 'SPMB tahun ajaran ini belum dibuka. Nantikan pengumuman resmi melalui website ini.' }}
                        </p>
                    </div>

                    {{-- CTA button --}}
                    <a href="{{ route('school.ppdb', ['school' => $school]) }}"
                       style="display: inline-flex; align-items: center; gap: 7px; background: #1a1814; color: #ffffff; font-weight: 600; font-size: 13px; padding: 12px 22px; border-radius: 11px; text-decoration: none; flex-shrink: 0; white-space: nowrap; transition: opacity 0.15s;"
                       onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
                        Informasi SPMB
                        <span class="material-symbols-outlined" style="font-size: 15px; line-height: 1;">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Sub note --}}
        <p style="text-align: center; color: #9c9887; font-size: 12px; margin-top: 14px;">
            Pantau terus halaman ini untuk pengumuman SPMB tahun ajaran berikutnya.
        </p>
    </div>
</section>
@endif

<script>
(function () {
    var countdownContainer = document.getElementById('ppdb-countdown');
    if (!countdownContainer) return;

    var targetIso = countdownContainer.dataset.target;
    if (!targetIso) return;

    var targetDate = new Date(targetIso);

    function pad(value) {
        return String(value).padStart(2, '0');
    }

    function updateCountdown() {
        var now = new Date();
        var diff = targetDate - now;

        if (diff <= 0) {
            document.getElementById('ppdb-days').textContent = '00';
            document.getElementById('ppdb-hours').textContent = '00';
            document.getElementById('ppdb-minutes').textContent = '00';
            document.getElementById('ppdb-seconds').textContent = '00';
            clearInterval(timer);
            return;
        }

        var totalSeconds = Math.floor(diff / 1000);
        var days = Math.floor(totalSeconds / 86400);
        var hours = Math.floor((totalSeconds % 86400) / 3600);
        var minutes = Math.floor((totalSeconds % 3600) / 60);
        var seconds = totalSeconds % 60;

        document.getElementById('ppdb-days').textContent = pad(days);
        document.getElementById('ppdb-hours').textContent = pad(hours);
        document.getElementById('ppdb-minutes').textContent = pad(minutes);
        document.getElementById('ppdb-seconds').textContent = pad(seconds);
    }

    updateCountdown();
    var timer = setInterval(updateCountdown, 1000);
})();
</script>

{{-- =========================================================
     3. SAMBUTAN KEPALA SEKOLAH
========================================================= --}}
<section class="w-full bg-white py-24">
    <div class="max-w-7xl mx-auto px-4 md:px-10">

        {{-- Section eyebrow --}}
        <div class="flex items-center gap-3 mb-14">
            <div class="h-px w-12 bg-slate-300"></div>
            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Sambutan Kepala Sekolah</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

            {{-- LEFT: photo --}}
            <div class="flex flex-col gap-6">
                <div class="overflow-hidden rounded-2xl bg-slate-100 aspect-4/5">
                    <img src="{{ $homepage->kepsek_photo_url ?? '/images/default-kepsek.jpg' }}"
                         alt="{{ $homepage->kepsek_name ?? 'Kepala Sekolah' }}"
                         class="w-full h-full object-cover object-top grayscale-20 hover:grayscale-0 transition-all duration-700">
                </div>
                <div class="flex flex-col gap-1 px-1">
                    <p class="text-slate-900 font-bold text-xl leading-snug">{{ $homepage->kepsek_name ?? 'Nama Kepala Sekolah' }}</p>
                    <p class="text-slate-500 text-sm">{{ $homepage->kepsek_title ?? 'Kepala Sekolah' }}, {{ $schoolConfig['name'] }}</p>
                </div>
            </div>

            {{-- RIGHT: content --}}
            <div class="flex flex-col justify-center gap-8 py-4">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight">
                    Selamat<br>Datang.
                </h2>

                <blockquote class="text-slate-600 text-lg md:text-xl leading-relaxed font-light border-l-2 border-slate-200 pl-6">
                    "{{ $homepage->kepsek_sambutan ?? 'Selamat datang di ' . $schoolConfig['name'] . '. Kami berkomitmen memberikan pendidikan terbaik yang berkarakter islami, unggul dalam akademik, dan berdaya saing untuk mempersiapkan generasi penerus bangsa yang berilmu dan berakhlak mulia.' }}"
                </blockquote>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================
     4. KEUNGGULAN
========================================================= --}}
<section class="w-full bg-white">

    {{-- Section header --}}
    <div class="max-w-7xl mx-auto px-6 md:px-12 pt-20 md:pt-28 pb-14 md:pb-20">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-8 h-0.5 bg-[#FDB913]"></div>
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.25em]">Mengapa Kami</span>
        </div>
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <h2 class="text-slate-900 text-4xl md:text-5xl lg:text-6xl font-black leading-tight max-w-xl">
                Keunggulan<br>{{ $schoolConfig['short_name'] }} Putra Pakuan
            </h2>

        </div>
    </div>

    {{-- Interactive: sticky tabs left / image right --}}
    <div class="flex flex-col lg:flex-row" id="keunggulan-root">

        {{-- LEFT: tab list (sticky on lg+) --}}
        <div class="lg:sticky lg:top-0 lg:h-screen flex flex-col justify-center lg:w-2/5 xl:w-[42%] shrink-0 bg-white border-r border-slate-100 z-10">
            <div class="px-6 md:px-12 xl:px-20 py-8 lg:py-0">
                @php $keunggulanCount = count($schoolConfig['keunggulan']); @endphp
                @foreach ($schoolConfig['keunggulan'] as $idx => $item)
                <button type="button"
                        data-idx="{{ $idx }}"
                        class="keunggulan-tab flex items-start gap-5 w-full text-left py-6 md:py-7 {{ $idx < $keunggulanCount - 1 ? 'border-b border-slate-100' : '' }} focus:outline-none">

                    {{-- Number --}}
                    <span class="tab-num shrink-0 text-6xl md:text-7xl font-black leading-none tabular-nums select-none transition-colors duration-300"
                          style="{{ $idx === 0 ? 'color:#FDB913' : 'color:#f1f5f9' }}">
                        {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Text --}}
                    <div class="pt-1.5 overflow-hidden">
                        <span class="material-symbols-outlined text-xl tab-icon transition-colors duration-300"
                              style="{{ $idx === 0 ? 'color:#64748b' : 'color:#cbd5e1' }}">{{ $item['icon'] }}</span>
                        <h3 class="tab-title font-bold text-lg md:text-xl leading-snug mt-1 transition-colors duration-300"
                            style="{{ $idx === 0 ? 'color:#0f172a' : 'color:#94a3b8' }}">{{ $item['title'] }}</h3>
                        <p class="tab-desc text-slate-500 text-sm leading-relaxed mt-2 overflow-hidden transition-all duration-500"
                           style="{{ $idx === 0 ? 'max-height:8rem;opacity:1' : 'max-height:0;opacity:0' }}">{{ $item['desc'] }}</p>
                    </div>
                </button>
                @endforeach
            </div>
        </div>

        {{-- RIGHT: image panels --}}
        @php
            $keunggulanImages = [
                'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1400&q=80&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=1400&q=80&auto=format&fit=crop',
            ];
        @endphp
        <div class="relative flex-1 h-[70vw] lg:h-screen overflow-hidden bg-slate-900">
            @foreach ($schoolConfig['keunggulan'] as $idx => $item)
            <div class="keunggulan-img absolute inset-0 transition-opacity duration-700"
                 style="{{ $idx === 0 ? 'opacity:1;z-index:1' : 'opacity:0;z-index:0' }}">
                <img src="{{ $keunggulanImages[$idx] ?? $keunggulanImages[0] }}"
                     alt="{{ $item['title'] }}"
                     class="w-full h-full object-cover"
                     loading="{{ $idx === 0 ? 'eager' : 'lazy' }}">
                {{-- Overlay: darkened gradient from left + bottom --}}
                <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute inset-0 bg-linear-to-r from-black/30 to-transparent"></div>

                {{-- Caption bottom-right --}}
                <div class="absolute bottom-8 right-8 text-right">
                    <p class="text-white/50 text-[10px] uppercase tracking-widest mb-1">
                        {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($keunggulanCount, 2, '0', STR_PAD_LEFT) }}
                    </p>
                    <p class="text-white font-bold text-lg md:text-xl">{{ $item['title'] }}</p>
                </div>

                {{-- Progress bar bottom --}}
                <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-white/10">
                    <div class="keunggulan-progress h-full bg-[#FDB913] w-0 transition-none"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script>
(function () {
    var root = document.getElementById('keunggulan-root');
    if (!root) return;

    var tabs  = Array.from(root.querySelectorAll('.keunggulan-tab'));
    var imgs  = Array.from(root.querySelectorAll('.keunggulan-img'));
    var bars  = Array.from(root.querySelectorAll('.keunggulan-progress'));
    var DURATION = 5000;
    var current = 0;
    var timer, barTimer;

    function activate(i, resetAuto) {
        tabs.forEach(function (tab, j) {
            var num   = tab.querySelector('.tab-num');
            var title = tab.querySelector('.tab-title');
            var icon  = tab.querySelector('.tab-icon');
            var desc  = tab.querySelector('.tab-desc');
            var active = j === i;
            num.style.color   = active ? '#FDB913' : '#f1f5f9';
            title.style.color = active ? '#0f172a'  : '#94a3b8';
            icon.style.color  = active ? '#64748b'  : '#cbd5e1';
            desc.style.maxHeight = active ? '8rem' : '0';
            desc.style.opacity   = active ? '1'    : '0';
        });
        imgs.forEach(function (img, j) {
            img.style.opacity = j === i ? '1' : '0';
            img.style.zIndex  = j === i ? '1' : '0';
        });
        bars.forEach(function (bar) {
            bar.style.transition = 'none';
            bar.style.width = '0%';
        });
        if (resetAuto !== false) {
            clearInterval(timer);
            clearTimeout(barTimer);
            animateBar(i);
            timer = setInterval(function () {
                current = (current + 1) % tabs.length;
                activate(current);
            }, DURATION);
        }
        current = i;
    }

    function animateBar(i) {
        var bar = bars[i];
        if (!bar) return;
        barTimer = setTimeout(function () {
            bar.style.transition = 'width ' + DURATION + 'ms linear';
            bar.style.width = '100%';
        }, 30);
    }

    activate(0, true);

    tabs.forEach(function (tab, i) {
        tab.addEventListener('click', function () { activate(i, true); });
    });
})();
</script>

{{-- =========================================================
     5. PROGRAM / JURUSAN  — Photo card grid
========================================================= --}}
<section class="w-full py-20 md:py-28" style="background: #020617;">

    {{-- Header --}}
    <div class="max-w-7xl mx-auto px-6 md:px-12 mb-14 md:mb-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-px" style="background:#FDB913"></div>
                    <span class="text-[11px] font-bold uppercase tracking-[0.25em]" style="color:#FDB913">
                        {{ $schoolConfig['short_name'] === 'SMK' ? 'Kompetensi Keahlian' : 'Program Unggulan' }}
                    </span>
                </div>
                <h2 style="color: #ffffff; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); line-height: 1.15;">
                    {{ $schoolConfig['short_name'] === 'SMK' ? 'Jurusan & Program Keahlian' : 'Program Unggulan Kami' }}
                </h2>
            </div>

        </div>
    </div>

    {{-- Card grid --}}
    @php
        $jurusanImages = [
            'https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&q=80&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=900&q=80&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=900&q=80&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=900&q=80&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=900&q=80&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=900&q=80&auto=format&fit=crop',
        ];
    @endphp
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
            @foreach ($schoolConfig['kurikulum'] as $idx => $item)
            @php
                $cardUrl = ($school === 'smk' && !empty($item['slug']))
                    ? route('school.jurusan.show', ['school' => $school, 'slug' => $item['slug']])
                    : route('school.ppdb', ['school' => $school]);
            @endphp
            <a href="{{ $cardUrl }}"
               class="group relative flex flex-col overflow-hidden rounded-2xl cursor-pointer"
               style="background:#111">

                {{-- Photo --}}
                <div class="relative overflow-hidden" style="aspect-ratio:4/3">
                    <img src="{{ $jurusanImages[$idx] ?? $jurusanImages[0] }}"
                         alt="{{ $item['title'] }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         loading="lazy">
                    {{-- Dark overlay always on, stronger on hover --}}
                    <div class="absolute inset-0 transition-opacity duration-300"
                         style="background:linear-gradient(180deg,transparent 30%,rgba(0,0,0,0.65) 100%)"></div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                         style="background:rgba(0,0,0,0.25)"></div>

                    {{-- Number badge top-left --}}
                    <div class="absolute top-4 left-4">
                        <span class="text-sm font-black tabular-nums px-2.5 py-1 rounded-lg"
                              style="background:rgba(0,0,0,0.5);color:rgba(255,255,255,0.5);backdrop-filter:blur(4px)">
                            {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    {{-- Colored top accent bar (shows on hover) --}}
                    <div class="absolute top-0 left-0 right-0 h-0.5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500"
                         style="background:{{ $item['color_hex'] }}"></div>
                </div>

                {{-- Content --}}
                <div class="flex flex-col flex-1 p-5 md:p-6" style="background:#111">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                             style="background:{{ $item['color_hex'] }}18">
                            <span class="material-symbols-outlined text-base leading-none"
                                  style="color:{{ $item['color_hex'] }}">{{ $item['icon'] }}</span>
                        </div>
                        <div class="w-px h-4" style="background:rgba(255,255,255,0.1)"></div>
                        <span class="text-[10px] font-bold uppercase tracking-widest" style="color:{{ $item['color_hex'] }}">
                            {{ $schoolConfig['short_name'] === 'SMK' ? 'Kompetensi Keahlian' : 'Program' }}
                        </span>
                    </div>
                    <h3 class="font-bold text-white text-base md:text-lg leading-snug mb-2">{{ $item['title'] }}</h3>
                    <p class="text-sm leading-relaxed flex-1" style="color:rgba(255,255,255,0.45)">{{ $item['desc'] }}</p>
                    <div class="flex items-center gap-1.5 mt-4 text-xs font-semibold transition-colors duration-300 group-hover:text-white"
                         style="color:rgba(255,255,255,0.3)">
                        Pelajari Selengkapnya
                        <span class="material-symbols-outlined text-sm transition-transform duration-300 group-hover:translate-x-1">arrow_forward</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================
     6. GALERI TERBARU
========================================================= --}}
<section class="w-full py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 md:px-10">

        <div class="flex items-end justify-between mb-10 gap-4 flex-wrap">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-5 h-px bg-[#FDB913]"></div>
                    <span class="text-xs font-semibold text-[#FDB913] uppercase tracking-[0.18em]">Dokumentasi</span>
                </div>
                <h2 class="text-slate-900 text-2xl md:text-3xl font-bold">Galeri Terbaru</h2>
                @if (!empty($schoolConfig['galeri_desc']))
                <p class="text-slate-500 text-sm mt-2 max-w-md">{{ $schoolConfig['galeri_desc'] }}</p>
                @endif
            </div>
            <a href="{{ route('school.galeri', ['school' => $school]) }}"
               class="flex items-center gap-1.5 text-slate-500 hover:text-slate-900 text-sm font-medium transition-colors">
                Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        @if ($latestGallery->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($latestGallery as $item)
            <a href="{{ route('school.galeri', ['school' => $school]) }}"
               class="group relative aspect-4/3 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 block bg-slate-200">
                <img src="{{ $item->image_url ?? '/images/default-gallery.jpg' }}"
                     alt="{{ $item->title }}"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-end p-4">
                    <p class="text-white font-semibold text-sm leading-snug opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">{{ $item->title }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-16 text-center gap-3">
            <span class="material-symbols-outlined text-slate-300 text-5xl">image_not_supported</span>
            <p class="text-slate-400 text-sm">Belum ada foto galeri yang dipublikasikan.</p>
        </div>
        @endif

    </div>
</section>

{{-- =========================================================
     7. BERITA TERBARU
========================================================= --}}
<section class="w-full py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-10">

        <div class="flex items-end justify-between mb-10 gap-4 flex-wrap">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-5 h-px bg-[#FDB913]"></div>
                    <span class="text-xs font-semibold text-[#FDB913] uppercase tracking-[0.18em]">Informasi</span>
                </div>
                <h2 class="text-slate-900 text-2xl md:text-3xl font-bold">Berita Terbaru</h2>
            </div>
            <a href="{{ route('school.berita', ['school' => $school]) }}"
               class="flex items-center gap-1.5 text-slate-500 hover:text-slate-900 text-sm font-medium transition-colors">
                Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        @if ($latestNews->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach ($latestNews as $news)
            <a href="{{ route('school.berita.detail', ['school' => $school, 'slug' => $news->slug]) }}"
               class="group flex flex-col bg-white rounded-xl border border-slate-200 hover:border-slate-300 hover:shadow-md transition-all duration-300 overflow-hidden">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="{{ $news->image_url ?? '/images/default-news.jpg' }}"
                         alt="{{ $news->title }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         loading="lazy">
                    @if ($news->category)
                    <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-semibold px-2 py-1 rounded uppercase tracking-wide">
                        {{ $news->category }}
                    </div>
                    @endif
                </div>
                <div class="flex flex-col flex-1 p-5 gap-2.5">
                    <p class="text-xs text-slate-400">
                        {{ optional($news->published_at)->isoFormat('D MMM YYYY') ?? '-' }}
                    </p>
                    <h3 class="font-bold text-slate-900 text-sm leading-snug group-hover:text-slate-700 transition-colors line-clamp-2">
                        {{ $news->title }}
                    </h3>
                    @if ($news->excerpt)
                    <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 flex-1">
                        {{ $news->excerpt }}
                    </p>
                    @endif
                    <div class="flex items-center gap-1 text-xs font-semibold text-slate-500 group-hover:text-slate-900 transition-colors mt-auto pt-1">
                        Baca selengkapnya <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-16 text-center gap-3">
            <span class="material-symbols-outlined text-slate-300 text-5xl">newspaper</span>
            <p class="text-slate-400 text-sm">Belum ada berita yang dipublikasikan.</p>
        </div>
        @endif

    </div>
</section>
