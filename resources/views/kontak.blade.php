@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<div class="w-full max-w-[1200px] mx-auto px-4 sm:px-8 pt-6">
    <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wider text-text-muted-light dark:text-text-muted-dark mb-4">
        <a class="hover:text-primary transition-colors" href="/">Beranda</a>
        <span>/</span>
        <span class="text-primary">Kontak</span>
    </div>
</div>
<title>Contact - Yayasan Putra Pakuan</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
                "primary": "#13a4ec",
                "primary-hover": "#0e8bc9",
                "background-light": "#f6f7f8",
                "background-dark": "#101c22",
                "surface-light": "#ffffff",
                "surface-dark": "#1a2c35",
                "text-main-light": "#0d171b",
                "text-main-dark": "#e7eff3",
                "text-secondary-light": "#4c809a",
                "text-secondary-dark": "#9ab6c5",
                "border-light": "#cfdfe7",
                "border-dark": "#2a3e4b",
              },
              fontFamily: {
                "display": ["Lexend", "sans-serif"]
              },
              borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
            },
          },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-main-light dark:text-text-main-dark transition-colors duration-200">
<div class="relative flex min-h-screen flex-col overflow-x-hidden">

<main class="flex-grow flex flex-col">
<!-- Hero Section -->
<section class="relative px-4 py-12 md:px-10 lg:px-40 bg-white dark:bg-surface-dark transition-colors">
<div class="mx-auto max-w-7xl">
<div class="@container">
<div class="flex flex-col gap-10 md:gap-16 lg:flex-row items-center">
<div class="flex-1 flex flex-col gap-6 text-left">
<div class="flex flex-col gap-4">
<h1 class="text-4xl font-black leading-tight tracking-[-0.033em] mb-3 text-primary dark:text-white">
    Hubungi Kami
</h1>
<p class="text-text-muted-light dark:text-text-muted-dark text-lg leading-relaxed">
    Silakan hubungi kami untuk informasi lebih lanjut mengenai pendaftaran, fasilitas, atau pertanyaan lainnya.
</p>
</div>
<div class="flex flex-col sm:flex-row gap-4">
<button class="flex items-center justify-center gap-2 rounded-xl h-12 px-6 bg-[#25D366] hover:bg-[#20bd5a] text-white text-base font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
<span class="material-symbols-outlined">chat</span>
<span>Start WhatsApp Chat</span>
</button>
<button class="flex items-center justify-center gap-2 rounded-xl h-12 px-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark hover:bg-gray-50 dark:hover:bg-gray-800 text-base font-bold transition-colors">
<span>Read FAQ</span>
</button>
</div>
<p class="text-sm text-text-secondary-light dark:text-text-secondary-dark flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">bolt</span>
                                    Typical response time: Under 2 hours
                                </p>
</div>
<div class="w-full lg:w-1/2 aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl relative group">
<div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10"></div>
<div class="w-full h-full bg-center bg-cover transition-transform duration-700 group-hover:scale-105" data-alt="Modern school building reception area with friendly staff" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCPlVWAUB2dSyNYiATNSwv_C4f3-ozw5BceSeRE4-EtgUHseXFWtnlELxqRliKwYXp7BHb38gZfwbYkf-FC8a4J8lpB4kv-nP50TRxeQlFPqdRBPY75MlMQcqoY-CbttUfbBeJo3jhaUwYJVbjmnhAMuu4zb0b17TVYvBE13GOcxIwHz3GvCki4fngTSgs9Dxau2sGgSMZOzYGy3PVXH_6rVrjTuuPnRhi5EvRyWwNmo4PGSTQSa10zwp451KY8zDsaQosEe9nzUFo");'>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Main Content Area: Contact Info & Form -->
<section class="px-4 py-16 md:px-10 lg:px-40 bg-background-light dark:bg-background-dark">
<div class="mx-auto max-w-7xl">
<div class="grid lg:grid-cols-12 gap-10">
<!-- Left Column: Contact Methods & Map -->
<div class="lg:col-span-5 flex flex-col gap-8">
<h2 class="text-2xl font-bold tracking-tight mb-2">Ways to Reach Us</h2>
<!-- Cards Grid -->
<div class="grid gap-4">
<!-- WhatsApp Card -->
<div class="flex items-start gap-4 rounded-2xl bg-white dark:bg-surface-dark p-5 shadow-sm border border-border-light dark:border-border-dark hover:border-[#25D366] transition-colors group cursor-pointer">
<div class="size-12 rounded-full bg-[#E7F9EE] dark:bg-[#10301d] text-[#25D366] flex items-center justify-center shrink-0">
<span class="material-symbols-outlined">chat</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-bold text-lg">WhatsApp Center</h3>
<p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-2">Instant support for quick questions regarding schedules or fees.</p>
<span class="text-primary font-semibold text-sm group-hover:underline">Open Chat →</span>
</div>
</div>
<!-- Email Card -->
<div class="flex items-start gap-4 rounded-2xl bg-white dark:bg-surface-dark p-5 shadow-sm border border-border-light dark:border-border-dark">
<div class="size-12 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined">mail</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-bold text-lg">General Inquiries</h3>
<p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Email us for admissions packets or detailed requests.</p>
<a class="text-text-main-light dark:text-text-main-dark font-medium mt-1" href="mailto:info@putrapakuan.sch.id">info@putrapakuan.sch.id</a>
</div>
</div>
<!-- Phone Card -->
<div class="flex items-start gap-4 rounded-2xl bg-white dark:bg-surface-dark p-5 shadow-sm border border-border-light dark:border-border-dark">
<div class="size-12 rounded-full bg-orange-50 dark:bg-orange-900/20 text-orange-500 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined">call</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="font-bold text-lg">Call Us</h3>
<p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Mon-Fri: 07:00 - 16:00</p>
<a class="text-text-main-light dark:text-text-main-dark font-medium mt-1" href="tel:+622112345678">+62 21 1234 5678</a>
</div>
</div>
</div>
<!-- Map Section -->
<div class="rounded-2xl overflow-hidden border border-border-light dark:border-border-dark shadow-sm h-64 relative bg-white dark:bg-surface-dark">
<div class="w-full h-full bg-cover bg-center" data-alt="Map showing location of Yayasan Putra Pakuan in Bogor" data-location="Bogor, Indonesia" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTeuw32fvfuhkkNeSqq-LMVX_715T-O5lk_XP3CRdenlUsza9ozHy0b6RE67EBxUMyMTEJeq1eB9ojcIgtC6ObCKYpLh-Vh7wQxN3OEE7C410mBlSNk_nt73rS51LiHYlu11MZUpl_Pz5_oPUrg4G7ljLnZpfluj0k3A7Mwfr3hpxjvevipa6ZtgGJNsBkYsQ-oCAT3PkvOjTtfESeMkdMbKepgil9DXqPi0QQeaJhWxMKU7qtGh0Agz7OvPG4JjDTU1QAU4cd5iw");'>
<!-- Overlay for map feel -->
<div class="absolute inset-0 bg-slate-900/10 flex items-center justify-center group cursor-pointer hover:bg-slate-900/20 transition-colors">
<div class="bg-white dark:bg-surface-dark px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
<span class="material-symbols-outlined text-red-500">location_on</span>
<span class="font-bold text-sm">View on Google Maps</span>
</div>
</div>
</div>
</div>
<div class="flex items-start gap-2 text-sm text-text-secondary-light dark:text-text-secondary-dark px-2">
<span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5">pin_drop</span>
<p>Jl. Pakuan No. 1, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16129</p>
</div>
</div>
<!-- Right Column: Inquiry Form -->
<div class="lg:col-span-7">
<div class="bg-white dark:bg-surface-dark rounded-3xl p-8 shadow-md border border-border-light dark:border-border-dark h-full">
<div class="mb-8">
<h2 class="text-2xl font-bold mb-2">Send us a Message</h2>
<p class="text-text-secondary-light dark:text-text-secondary-dark">Fill out the form below and we'll direct your inquiry to the right department.</p>
</div>
<form class="flex flex-col gap-6">
<!-- Inquiry Type Dropdown -->
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-text-main-light dark:text-text-main-dark" for="inquiry-type">Topic</label>
<div class="relative">
<select class="w-full appearance-none rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark px-4 py-3 text-base text-text-main-light dark:text-text-main-dark focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-shadow" id="inquiry-type">
<option>Admissions Inquiry</option>
<option>Tuition &amp; Finance</option>
<option>Academic Questions</option>
<option>Student Life</option>
<option>General Information</option>
</select>
<span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-text-secondary-light dark:text-text-secondary-dark material-symbols-outlined">expand_more</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-text-main-light dark:text-text-main-dark" for="parent-name">Parent Name</label>
<input class="w-full rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark px-4 py-3 text-base text-text-main-light dark:text-text-main-dark focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-shadow placeholder:text-text-secondary-light/50" id="parent-name" placeholder="Enter your full name" type="text"/>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-text-main-light dark:text-text-main-dark" for="student-id">Student ID <span class="font-normal text-text-secondary-light dark:text-text-secondary-dark">(Optional)</span></label>
<input class="w-full rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark px-4 py-3 text-base text-text-main-light dark:text-text-main-dark focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-shadow placeholder:text-text-secondary-light/50" id="student-id" placeholder="e.g. 2024-001" type="text"/>
</div>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-text-main-light dark:text-text-main-dark" for="email">Email Address</label>
<input class="w-full rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark px-4 py-3 text-base text-text-main-light dark:text-text-main-dark focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-shadow placeholder:text-text-secondary-light/50" id="email" placeholder="name@example.com" type="email"/>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-text-main-light dark:text-text-main-dark" for="message">How can we help?</label>
<textarea class="w-full rounded-xl border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark px-4 py-3 text-base text-text-main-light dark:text-text-main-dark focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-shadow resize-none placeholder:text-text-secondary-light/50" id="message" placeholder="Please describe your question or concern..." rows="5"></textarea>
</div>
<div class="mt-2">
<button class="w-full rounded-xl bg-primary hover:bg-primary-hover text-white font-bold py-3.5 px-6 transition-all hover:shadow-lg shadow-md flex items-center justify-center gap-2" type="button">
<span>Submit Message</span>
<span class="material-symbols-outlined text-[20px]">send</span>
</button>
<p class="text-center text-xs text-text-secondary-light dark:text-text-secondary-dark mt-4">
                                            By submitting this form, you agree to our privacy policy regarding parent data communication.
                                        </p>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- FAQ Teaser -->
<section class="border-t border-border-light dark:border-border-dark bg-white dark:bg-surface-dark py-12 px-4 md:px-10 lg:px-40">
<div class="mx-auto max-w-4xl text-center">
<div class="inline-flex items-center justify-center size-12 rounded-full bg-primary/10 text-primary mb-4">
<span class="material-symbols-outlined">help</span>
</div>
<h2 class="text-2xl font-bold mb-3 text-text-main-light dark:text-text-main-dark">Often Asked Questions</h2>
<p class="text-text-secondary-light dark:text-text-secondary-dark mb-8">Before you reach out, you might find the answer you're looking for in our curated list of frequently asked questions.</p>
<a class="inline-flex items-center justify-center gap-2 text-primary font-bold hover:underline" href="#">
                        Visit Help Center
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
</div>
</section>
</main>

<!-- Floating WhatsApp Button -->
{{-- <div class="fixed bottom-6 right-6 z-50">
<button aria-label="Chat on WhatsApp" class="flex items-center justify-center size-14 rounded-full bg-[#25D366] text-white shadow-xl hover:scale-110 transition-transform cursor-pointer">
<span class="material-symbols-outlined text-[32px]">chat</span>
</button>
</div> --}}
</div>
</body>
@endsection
