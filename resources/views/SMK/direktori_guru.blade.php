@extends('layouts.SMK.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Section -->
    <div class="relative rounded-xl overflow-hidden mb-12 bg-charcoal dark:bg-black h-80 flex flex-col justify-center items-center text-center p-8">
        <div class="absolute inset-0 opacity-40">
            <div class="w-full h-full bg-linear-to-br from-charcoal via-primary/20 to-accent-yellow/20" data-alt="Abstract geometric background in charcoal and blue"></div>
        </div>
        <div class="relative z-10 space-y-4 max-w-2xl">
            <h2 class="text-4xl md:text-5xl font-black text-white leading-tight">Direktori Civitas Akademika</h2>
            <p class="text-slate-300 text-lg">Temukan profil tenaga pendidik dan staf profesional yang berdedikasi tinggi di SMK Putra Pakuan.</p>
            <div class="flex gap-3 justify-center pt-4">
                <span class="px-4 py-1.5 bg-primary/20 border border-primary/30 text-primary text-xs font-bold rounded-full uppercase tracking-tighter">120+ Staf</span>
            </div>
        </div>
    </div>
    <!-- Search & Filter Controls -->
    <div class="bg-background-light dark:bg-background-dark py-4 space-y-4 rounded-xl shadow-sm mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input class="w-full pl-12 pr-4 py-3.5 bg-white dark:bg-charcoal border-none rounded-xl focus:ring-2 focus:ring-primary shadow-sm text-sm placeholder:text-slate-400 transition-all" placeholder="Cari nama guru, jabatan, atau mata pelajaran..." type="text"/>
            </div>
            <!-- Dropdown Filter -->
            <div class="relative w-full md:w-64">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">filter_list</span>
                <select class="w-full pl-12 pr-4 py-3.5 bg-white dark:bg-charcoal border-none rounded-xl focus:ring-2 focus:ring-primary shadow-sm text-sm appearance-none transition-all">
                    <option value="">Semua Departemen</option>
                    <option value="management">Manajemen Sekolah</option>
                    <option value="tkj">Teknik Komputer &amp; Jaringan</option>
                    <option value="rpl">Rekayasa Perangkat Lunak</option>
                    <option value="umum">Mata Pelajaran Umum</option>
                    <option value="admin">Staf Administrasi</option>
                </select>
            </div>
        </div>
        <!-- Quick Filter Tags -->
        <div class="flex gap-2 overflow-x-auto pb-2 no-scrollbar">
            <button class="px-5 py-2 rounded-lg bg-primary text-white text-xs font-bold whitespace-nowrap">Semua</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Guru Produktif</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Wali Kelas</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Staf IT</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Laboran</button>
            <button class="px-5 py-2 rounded-lg bg-white dark:bg-charcoal border border-slate-200 dark:border-slate-800 hover:border-primary text-xs font-semibold whitespace-nowrap transition-all">Bimbingan Konseling</button>
        </div>
    </div>
    <!-- Directory Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Card 1: Headmaster -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Hj. Siti Aminah" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Hj. Siti Aminah, M.Pd. in formal attire" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3pX_QBB3NhrxW6WGDTTVO2Fr15kRmQ7Kzs0fCv5spYBeWhMtEqGP1sHatsosC0BWPhJqhHHhg45P_8OWdaBIdQKv007TyHJRpcyQwKB4Hky6VWiHC7Oq6F_moOm-9_CdZIQkJtaLGA4CM3UvLzBfpV4cK9LjuLOuCjgDy96dionZoYrFvnu2LuiYW4TZd4tOj6QD5qDwUc1oiRAT9SP10NqqA4fQX6mg1Er7_Dxsh-q7RE_jXAEfXsC4IKZ6vf6vLaq6ks7i46Q"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-accent-yellow text-charcoal text-[10px] font-bold rounded-full uppercase">Manajemen</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Hj. Siti Aminah, M.Pd.</h3>
                <p class="text-primary text-sm font-medium">Kepala Sekolah</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">alternate_email</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 2: Apid Sutarno -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Apid Sutarno" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Apid Sutarno, S.T. wearing school uniform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBSnhLpEkjBFVxSf8y7OxFHcYzhpyhcdBPzZ1ugHp58FPLERxoz5b6QQbg800T4NTg4-UYPAOtrTCwHPUN5NZIPJxh896gOjMliss854Vw-3RfeZZyyWlOUFxKpH5QA2EDxCDgJDfXjVjLuvGuXKGJo4FdkeQPC0y9leQlGPS74aXBxqkYqgRA1Urgahm8b8qOgpRDaFz-js8a60gicuDbi7BVooyr_5wEzXH6Vrn4Jyqh7DSyIZbdELghDprmqAsFcRtPGrNJRvg"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-primary text-white text-[10px] font-bold rounded-full uppercase">Teknik (TKJ)</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Apid Sutarno, S.T.</h3>
                <p class="text-primary text-sm font-medium">Kepala Program Keahlian TKJ</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">link</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">videocam</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 3: Budi Raharjo -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Budi Raharjo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Budi Raharjo, S.Kom. teacher of Computer Science" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0MAnRW29-TD8dugQgHfAYO0r1CaMeIqavnKjgsL44fDLvOfr5SOIgGiEdBkZQtnfCRDQGbrJE8p1KIi7JNmIq7-JciHc65rXRJB3szqZ-e0w3FmETRX0vXPWTQfG2nLdLktl5mDfOL-EEgtn1-D9uAe_i2DeQFkHEBts9RtoYwfgUp1rBUQZM7CC7BbWmIz_IUxcGGz4kSLze2jmF3TbZFOqMX6NrQRf5T4O5-1RV8ImxsHma-5PgPNDi4GfcoG81NLTVsS1GyQ"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-primary text-white text-[10px] font-bold rounded-full uppercase">Teknik (RPL)</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Budi Raharjo, S.Kom.</h3>
                <p class="text-primary text-sm font-medium">Guru Teknik Komputer</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">share</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 4: Dewi Lestari -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Dewi Lestari" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Dewi Lestari, S.Pd. English teacher" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDITP5xPyf5kYK5GnFGgmOpEbkMnfL9amOtP3Ymc0R8eey_TekDkMmVpG5TewBz-u4EsrD44lfY07mk1UghTgvrPz6ZNAk05YNgPR3c9_EdKEkSgs0DdEc9CQObu3Xu3DyGBqeWs9Qqb0R5nht7yLWhT4LukSB4PnuzodrMjS2WU2RrKmG4uV704r4orDrUi78YluAWBSDkIjZ1lnpOUZnKQY7PS5GKsJD8XCCbuohsR3EYUQQEwLDFVR_dwl331IOyUHgyscNpA"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-slate-400 text-white text-[10px] font-bold rounded-full uppercase">Umum</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Dewi Lestari, S.Pd.</h3>
                <p class="text-primary text-sm font-medium">Guru Bahasa Inggris</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 5: Ahmad Fauzi -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Ahmad Fauzi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Ahmad Fauzi, M.T. in vice principal attire" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOKRasaEeWEATbjADY85AyJumcJtm1aJcSVTkzV1e8M2VhM7IiJ_bwTeDuZ7a3goJOAolzvNUMS2epW3c4-LUIyvlwHyk97-7ioBVbUWJmuu5gq6iJhHaW2Xqlac3Q4iyf3OpfXLk5JFnt49zYW3uvdGCg2UoxBBO6GtRAfBSK0pXO8iSpEDFVKrA23D8ojMsNTloiGQUfS-FXQN_rbrIdjXh7mnVLS2dRy5dR85OB7rzEFGkrOiHsRIw9H50OCl-bJtno-Bbe7w"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-accent-yellow text-charcoal text-[10px] font-bold rounded-full uppercase">Manajemen</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Ahmad Fauzi, M.T.</h3>
                <p class="text-primary text-sm font-medium">Waka Hubungan Industri</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">work</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 6: Rina Wijaya -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Rina Wijaya" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Rina Wijaya, S.E. financial officer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-lwd88qkBOt01DD13LMDPeLvhMPrx0dyShAV5Wna1gBiJa7UiCBjaI6Ov4pSfRVcXy-DObiyBsHd9kWElPSHa0W2-zVuaWy8TV9GPKRvgeQpq_bi0-Lyv5AoyxvHu6-fhv0CrLrGWWe9MNRonfPP8wKgapBiL6LGK1kKWA2HW9GpXquT1z7tnL_9rP0vXAPKW-1BZ16KfiFsbJnCgWEYxvh28FPOjOFY4lGbaEuscJc8BsoKSc8caWOFNTtTuLjyN0QwEv0ak4w"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-slate-500 text-white text-[10px] font-bold rounded-full uppercase">Staf Admin</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Rina Wijaya, S.E.</h3>
                <p class="text-primary text-sm font-medium">Bendahara Sekolah</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 7: Hendra Kurniawan -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Hendra Kurniawan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Dr. Hendra Kurniawan mathematics teacher" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCG_3d1hpOMI82hzgip4cvmQesL5kbHDJ4XE5lJPfvC2ULxiXOeIqilqVZ4RVm6k0u4D4M_u1TZs_BJymjNEZVEKYKcTR7EhxStdt2BBgwFXNou2jMdFbexhuxV-s6rpUw4W4xR7AFRO3frAc02KLcUGAK_3UHP0fL0W5z0Ke1nte317RRyEYsasLLrurCYj1CgKCBZycl5CARyX6WO5nGuQTp-DxCnE7CAjaso6FAOgyiAGTSwWzxcpvZpILVtll9HsUMVyWjBAw"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-slate-400 text-white text-[10px] font-bold rounded-full uppercase">Umum</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Dr. Hendra Kurniawan</h3>
                <p class="text-primary text-sm font-medium">Guru Matematika</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">school</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 8: Siska Putri -->
        <div class="group bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
            <div class="aspect-3/4 relative overflow-hidden">
                <img alt="Siska Putri" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of Siska Putri, S.Si. laboratory staff" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCv_VV6NcpS43hgxbw_YwcmuZVkPida8yxp5TQwWWWftHI2bqwYYNggcBj1EUhXNCzj8MUrKFE96BlYfO8_aQyQfROSBI1O7qan3CjCcPLBx_25li5H3wik5MLFa8xi--wJHeOoq0XAvHFbNxHvf4cCSDMOfMRTF0R5F0jX_fYvtis460ddG49BofCHarBt1Ervc-xnLpBVKUOZVgcC_LhfyWUHLSPRk5N4CV_KPMtoQ7J_X7xDYCI5Ni4lC_0lzxJJy0xP-pDlNw"/>
                <div class="absolute top-4 right-4 px-3 py-1 bg-emerald-500 text-white text-[10px] font-bold rounded-full uppercase">Laboran</div>
            </div>
            <div class="p-5 space-y-2">
                <h3 class="text-lg font-bold text-charcoal dark:text-white leading-tight">Siska Putri, S.Si.</h3>
                <p class="text-primary text-sm font-medium">Laboran Kimia Industri</p>
                <div class="pt-3 flex gap-3">
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">science</span>
                    </a>
                    <a class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-800 text-primary hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <div class="mt-16 flex flex-col items-center gap-6">
        <p class="text-sm text-slate-500 dark:text-slate-400">Menampilkan 8 dari 124 Staf &amp; Pengajar</p>
        <div class="flex items-center gap-2">
            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold">1</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">2</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">3</button>
            <span class="px-2">...</span>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">16</button>
            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </div>
</div>
@endsection
