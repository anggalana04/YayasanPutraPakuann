@extends('layouts.app')

@section('content')
<div class="w-full">
    <!-- Hero Section -->
    <section class="relative w-full">
        <div class="layout-container max-w-[1280px] mx-auto px-4 md:px-10 py-5">
            <div class="@container">
                <div class="@[480px]:p-0">
                    <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl items-center justify-center p-8 relative overflow-hidden shadow-lg" data-alt="Students learning together in a bright modern classroom environment" style='background-image: linear-gradient(rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCyxKfVDeLSWPV1yQB0WFPdY5Q10HNTcC3AtqpQRxhyqODYmqqxpeZhZFqT6ZDQkZBPAXoE_EqgO71INcV3ooRr3hGzNbMjjFoqXTYhuL41Yy2bp2HYA81i711p3gVIjD8kupvIzmy2oXVeQ0YC8XuiIBSsxWPSGBUDfZOFkUKAD5826KpWIiH4V7Cd6lfb1b6iw6feCWgJDuFn4iClKqnu7_rber9eUm8yw7ocikKyZWC-BsFX6MaAZSqepE-B59BHpAN8n_m_YUA");'>
                        <div class="relative z-10 flex flex-col gap-4 text-center max-w-[720px]">
                            <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] md:text-5xl lg:text-6xl drop-shadow-sm">
                                Shaping the Future of Putra Pakuan
                            </h1>
                            <h2 class="text-slate-100 text-lg font-medium leading-relaxed md:text-xl">
                                Guided by purpose, driven by excellence. We nurture the next generation of leaders.
                            </h2>
                        </div>
                        <div class="relative z-10 pt-4">
                            <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-12 px-8 bg-primary hover:bg-sky-500 text-white text-base font-bold shadow-lg transition-transform active:scale-95">
                                <span class="truncate">Learn More About Us</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section (Retained) -->
    <section class="py-8 px-4 sm:px-10">
        <div class="max-w-[1280px] mx-auto w-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat 1 -->
                <div class="flex flex-col gap-2 rounded-2xl p-8 bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary/50 transition-colors group">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined text-primary text-3xl group-hover:scale-110 transition-transform">history_edu</span>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wide">Legacy</p>
                    </div>
                    <p class="text-slate-900 dark:text-white text-4xl font-black">34 Years</p>
                    <p class="text-slate-600 dark:text-slate-300">Of educational excellence</p>
                </div>
                <!-- Stat 2 -->
                <div class="flex flex-col gap-2 rounded-2xl p-8 bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary/50 transition-colors group">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined text-primary text-3xl group-hover:scale-110 transition-transform">groups</span>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wide">Community</p>
                    </div>
                    <p class="text-slate-900 dark:text-white text-4xl font-black">1,200+</p>
                    <p class="text-slate-600 dark:text-slate-300">Active students enrolled</p>
                </div>
                <!-- Stat 3 -->
                <div class="flex flex-col gap-2 rounded-2xl p-8 bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary/50 transition-colors group">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined text-primary text-3xl group-hover:scale-110 transition-transform">domain</span>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wide">Growth</p>
                    </div>
                    <p class="text-slate-900 dark:text-white text-4xl font-black">3 Campuses</p>
                    <p class="text-slate-600 dark:text-slate-300">Across the region</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Section (Retained) -->
    <section class="py-16 px-4 sm:px-10 bg-white dark:bg-slate-900">
        <div class="max-w-[1080px] mx-auto w-full grid md:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 bg-primary/10 rounded-full blur-2xl"></div>
                <img alt="Portrait of the chairperson" class="relative rounded-2xl shadow-xl w-full aspect-[4/5] object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA06esJmDOcG-GFBZU4F0IGi2w6w_aM0u1JyIHuGhpEwmDsRYUUgrYp6Hv1oIsXHH2c1VHm9I1q9trZ60C5rHe6mYLYzq5CINZ-bYo9KzPhLcy0tocrXDzWIt0L8gqUrlBY865VjhuusntijpLL2KlX50DXgfaL2RjzWoMqEVOUe3uOOPdhGq5jcwJaQYthce2de3J0DIwKfMR6IUSjh0aS_IIaIc6KEQixDD0A-Gp8bFqu7OsEe7pI5euIbgU2wOxQluKESXldfbs"/>
                <div class="absolute -bottom-6 -right-6 w-48 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700">
                    <p class="font-bold text-slate-900 dark:text-white">Dr. Sarah Wijaya</p>
                    <p class="text-sm text-primary">Chairperson</p>
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-slate-900 dark:text-white text-3xl sm:text-4xl font-bold leading-tight mb-6">
                    Welcome to Yayasan Putra Pakuan
                </h2>
                <div class="space-y-4 text-slate-600 dark:text-slate-300 text-lg leading-relaxed">
                    <p>
                        It is my privilege to welcome you to Yayasan Putra Pakuan. Our journey began with a simple vision: to create a learning environment where every child feels valued, challenged, and supported.
                    </p>
                    <p>
                        Today, we continue that legacy with a parent-first approach. We believe that education is a partnership between the school and the family. By fostering open communication and active involvement, we ensure that our students not only excel academically but also grow into compassionate, responsible leaders.
                    </p>
                    <p>
                        Thank you for entrusting us with your child's future.
                    </p>
                </div>
                <!-- Signature -->
                <div class="mt-8">
                    <img alt="Signature" class="h-12 w-auto opacity-70 dark:invert" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOY4QEIYJMNIM_k2wkkZpNWRMpvLUUqfd9mnqQXUFK-tIupSeP_M_rWAdTAcjrweFz9FYkjFFbDc3a1sBPu0mVo_-qxQmc6zP8uLjPl7uCsHzqMLfN90B8SwH0NMszuu24GcaTTN-VAqRyxWcmPrZHXCPDPyY67dZ56Ld7nRsKxLsHhZw-nJ6n5Onxj1kdEN8OTNR1DclrLcy9IzNjBaGdsLSZMN88JPKRQGAkk_97XW_ZKxssXgrgTa2Zb5CbEPTxJhe725tEDIQ"/>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Card Section -->
    <section class="py-10">
        <div class="layout-container max-w-[1280px] mx-auto px-4 md:px-10">
            <div class="bg-cover bg-center flex flex-col items-center justify-center rounded-2xl p-10 md:p-16 shadow-md relative overflow-hidden group" style="background-image: linear-gradient(135deg, #13a4ec 0%, #0c6ba1 100%);">
                <!-- Decorative overlay -->
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="relative z-10 flex flex-col gap-6 text-center max-w-[800px]">
                    <div class="flex justify-center">
                        <div class="bg-white/20 p-3 rounded-full backdrop-blur-sm">
                            <span class="material-symbols-outlined text-white text-4xl">visibility</span>
                        </div>
                    </div>
                    <h2 class="text-white tracking-tight text-3xl md:text-4xl font-bold">Our Vision</h2>
                    <p class="text-white text-lg md:text-2xl font-medium leading-relaxed">
                        "To be a beacon of educational excellence that nurtures future leaders with strong moral character, innovative minds, and a compassionate heart for the community."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-12 bg-white dark:bg-slate-900/50">
        <div class="layout-container max-w-[1280px] mx-auto px-4 md:px-10">
            <div class="flex flex-col gap-10">
                <div class="flex flex-col gap-4 text-center md:text-left">
                    <h2 class="text-slate-900 dark:text-white tracking-tight text-3xl md:text-4xl font-black leading-tight">
                        Our Mission
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-lg font-normal leading-relaxed max-w-[720px]">
                        We are dedicated to providing a holistic environment where every student thrives. Our mission is broken down into three core pillars.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Mission Item 1 -->
                    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 dark:border-slate-800 bg-background-light dark:bg-slate-800 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-primary w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl">school</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">Academic Excellence</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                                Delivering a rigorous, forward-thinking curriculum that prepares students for global challenges through critical thinking and problem-solving.
                            </p>
                        </div>
                    </div>
                    <!-- Mission Item 2 -->
                    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 dark:border-slate-800 bg-background-light dark:bg-slate-800 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-primary w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl">volunteer_activism</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">Character Building</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                                Instilling core values of integrity, respect, and responsibility in every aspect of school life to mold well-rounded individuals.
                            </p>
                        </div>
                    </div>
                    <!-- Mission Item 3 -->
                    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 dark:border-slate-800 bg-background-light dark:bg-slate-800 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-primary w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl">diversity_3</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">Community Engagement</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                                Fostering strong partnerships between parents, teachers, and the local society to create a supportive ecosystem for learning.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bringing Values to Life Section (Alternating) -->
    <section class="py-16">
        <div class="layout-container max-w-[1280px] mx-auto px-4 md:px-10 flex flex-col gap-16">
            <div class="text-center mb-4">
                <h2 class="text-slate-900 dark:text-white text-3xl font-bold leading-tight tracking-[-0.015em]">Bringing Values to Life</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-2">How we translate our vision into daily practice.</p>
            </div>
            <!-- Row 1: Text Left, Image Right -->
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="order-2 md:order-1 flex flex-col gap-4">
                    <div class="flex items-center gap-2 text-primary font-bold uppercase text-xs tracking-wider">
                        <span class="material-symbols-outlined text-lg">psychology</span>
                        <span>Holistic Curriculum</span>
                    </div>
                    <h3 class="text-slate-900 dark:text-white text-2xl md:text-3xl font-bold">More Than Just Textbooks</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">
                        At Yayasan Putra Pakuan, we believe education goes beyond grades. Our curriculum integrates arts, sports, and leadership training to ensure every child discovers their unique potential. We focus on emotional intelligence alongside academic rigor.
                    </p>
                    <div>
                        <a class="inline-flex items-center text-primary font-bold hover:underline" href="#">
                            Explore Academics <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <div class="aspect-video md:aspect-square w-full rounded-2xl bg-cover bg-center shadow-lg transform rotate-1 hover:rotate-0 transition-transform duration-500" data-alt="Teacher explaining science project" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBqKWNBBgCrDVLqG8xVbGXYioe7bExVFB06sj19JGiLWqNsoYWvMnLAtpxc9lnkULNtOGsDqMYc81Tu2HMUudc8xSfbUQgawMDN6cz7NZSvLD80j3U6ur7uwWCtghvsMdCGOsLjZMM63kOZ7iUtHqlFboIl61Dozv2V_HOV-qeh1VrIecsOwEKwvhYeDiEa6LB8nEM-dJnpvQnG8CiNz9Zzt0bQn9bk8vL0RwW2srnXAYh9AxCfKLpd84HBj8pEwCUN0iX0qZ-Xpxo");'>
                    </div>
                </div>
            </div>
            <!-- Row 2: Image Left, Text Right -->
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="order-1">
                    <div class="aspect-video md:aspect-square w-full rounded-2xl bg-cover bg-center shadow-lg transform -rotate-1 hover:rotate-0 transition-transform duration-500" data-alt="Parents and teachers discussing" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBwqknz0Hl5635Esj-e4V7eE1R3HNMmVuaTD8V0kyoR2FIzJQYYSvoYJCN9VrTF5EGe_M08QragWHS0bSQX07BHQaLrJeS1KCNhZbVOyAiuOwHT5EJAL9RysK8Bsx7w6ZD9tsohOLfUuANdfoboUbsg-PSuyhacFIP3g3oVxflU6KcmZc6kmZnAzQ7S24U1lCWx2qEE9oYgQnaIej84UWJ0O3roJ6EQHSepZh3L5n_pa-5mJh2H9I18FAJAoYFa2sUgy04iWvfT0Rs");'>
                    </div>
                </div>
                <div class="order-2 flex flex-col gap-4">
                    <div class="flex items-center gap-2 text-primary font-bold uppercase text-xs tracking-wider">
                        <span class="material-symbols-outlined text-lg">handshake</span>
                        <span>Parent Partnership</span>
                    </div>
                    <h3 class="text-slate-900 dark:text-white text-2xl md:text-3xl font-bold">Building Bridges with Families</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">
                        We view parents as our most valuable partners. Through regular workshops, the Parent Portal, and community events, we ensure you are an active participant in your child's journey. Together, we create a consistent support system.
                    </p>
                    <div>
                        <a class="inline-flex items-center text-primary font-bold hover:underline" href="#">
                            Join Our Community <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section (Retained) -->
    <section class="py-20 px-4 sm:px-10 bg-white dark:bg-slate-900 overflow-hidden">
        <div class="max-w-[1080px] mx-auto w-full">
            <div class="text-center mb-16">
                <h2 class="text-slate-900 dark:text-white text-3xl sm:text-4xl font-bold">From Humble Beginnings</h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400">A timeline of our journey towards excellence.</p>
            </div>
            <div class="relative">
                <!-- Vertical Line -->
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-slate-200 dark:bg-slate-700 -ml-px md:transform md:-translate-x-1/2"></div>
                <!-- Timeline Item 1 -->
                <div class="relative flex flex-col md:flex-row items-center mb-12">
                    <div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0 mb-4 md:mb-0">
                        <h3 class="text-2xl font-bold text-primary">1990</h3>
                        <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Foundation Established</h4>
                        <p class="text-slate-600 dark:text-slate-400">Yayasan Putra Pakuan was founded with a single classroom and 15 students, driven by a passion for quality local education.</p>
                    </div>
                    <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-primary rounded-full border-4 border-white dark:border-slate-900 transform -translate-x-1/2 z-10"></div>
                    <div class="flex-1 w-full md:w-1/2 md:pl-12 pl-12"></div>
                </div>
                <!-- Timeline Item 2 -->
                <div class="relative flex flex-col md:flex-row items-center mb-12">
                    <div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0 order-1 md:order-1 hidden md:block"></div>
                    <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-primary rounded-full border-4 border-white dark:border-slate-900 transform -translate-x-1/2 z-10"></div>
                    <div class="flex-1 w-full md:w-1/2 md:pl-12 pl-12 mb-4 md:mb-0 order-1 md:order-2">
                        <h3 class="text-2xl font-bold text-primary">2005</h3>
                        <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2">First Major Expansion</h4>
                        <p class="text-slate-600 dark:text-slate-400">Due to growing demand, we opened our second campus in the city center, adding a dedicated high school wing.</p>
                    </div>
                </div>
                <!-- Timeline Item 3 -->
                <div class="relative flex flex-col md:flex-row items-center mb-12">
                    <div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0 mb-4 md:mb-0">
                        <h3 class="text-2xl font-bold text-primary">2015</h3>
                        <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Digital Curriculum Adoption</h4>
                        <p class="text-slate-600 dark:text-slate-400">Pioneering the "Future-Ready" initiative, we integrated smart classrooms and coding into our core curriculum.</p>
                    </div>
                    <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-primary rounded-full border-4 border-white dark:border-slate-900 transform -translate-x-1/2 z-10"></div>
                    <div class="flex-1 w-full md:w-1/2 md:pl-12 pl-12"></div>
                </div>
                <!-- Timeline Item 4 -->
                <div class="relative flex flex-col md:flex-row items-center">
                    <div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0 order-1 md:order-1 hidden md:block"></div>
                    <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-white border-4 border-primary rounded-full transform -translate-x-1/2 z-10"></div>
                    <div class="flex-1 w-full md:w-1/2 md:pl-12 pl-12 mb-4 md:mb-0 order-1 md:order-2">
                        <h3 class="text-2xl font-bold text-primary">2024</h3>
                        <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2">New Science Wing</h4>
                        <p class="text-slate-600 dark:text-slate-400">Celebrating our 34th anniversary with the opening of state-of-the-art laboratories and a new parent community center.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Section (Retained) -->
    <section class="py-20 px-4 sm:px-10 bg-background-light dark:bg-background-dark">
        <div class="max-w-[1280px] mx-auto w-full">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 class="text-slate-900 dark:text-white text-3xl sm:text-4xl font-bold mb-4">Meet Our Leadership</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-xl">Dedicated professionals committed to the vision of Yayasan Putra Pakuan.</p>
                </div>
                <button class="text-primary font-bold hover:underline flex items-center gap-1">
                    View Board of Directors <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Profile 1 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative mb-6 overflow-hidden rounded-full w-40 h-40 border-4 border-white dark:border-slate-700 shadow-lg">
                        <img alt="Portrait of Dr. Sarah Wijaya" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9IJ6wHy4GCv8lH55vCSkj9jNJNTYdb73xCvX7qNFhYW0rpZ0_5Ryl2DVjyQM9kbIOvIdFGRHuyNiQlfzOsqIZ9Fgh2JB5vj0wonEbRB6kZW8Wr_lzRA-FW_BJ67iaS4oi4Z-pEZx4Qu1T1Jou4h5Kol5Iur0u3Cf1NnMf6MuFuz6cWKBx81AZ299LgJPRdw0u3Z1gOo5ec-gcqZ6-DtHOGA83wCH9jtXKyXoEDbnEYxfKAwk_fU44ju1SE0tKs4NUhUhfMEjdjcc"/>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Dr. Sarah Wijaya</h3>
                    <p class="text-sm text-primary font-medium mb-2">Chairperson</p>
                </div>
                <!-- Profile 2 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative mb-6 overflow-hidden rounded-full w-40 h-40 border-4 border-white dark:border-slate-700 shadow-lg">
                        <img alt="Portrait of Budi Santoso" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8eSsLcvJZ-5CLQNK2ULzpm37JJlqApr-LypkEWelPQ3Da_e5A5BV-boFlDXV4Zh5epKaWVprEYEOBRSYP0hAe_MF6B5o6ulooEinilttu5KaOM7R_D_3sgrjEx0Jt_cwP3dP5glx_wfWiO8dMJaq7ksPlx4epufjKvPNwoC-LeuR9Ug0OWQfvbYQ0pHRXnstKpohqEkIhwDB4kM_W8hKAf7h1zzeIuNxHURjeNnP7IG9hwGCXRFpuenT1wKILW6Oqgz5EaSpJitI"/>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Budi Santoso</h3>
                    <p class="text-sm text-primary font-medium mb-2">Head of Academics</p>
                </div>
                <!-- Profile 3 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative mb-6 overflow-hidden rounded-full w-40 h-40 border-4 border-white dark:border-slate-700 shadow-lg">
                        <img alt="Portrait of Linda Kusuma" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnZJ4E5Mf9i6-FEFja8-ksAnWubA0BrUZAQoKV1PLh4HI89ANXNPu907UBQI3wAH0FRSwCiCjNQBMWSSrmLznJopwtU4nSGsF96lrDvvTUmE8M9WR6Af5nlPTFFWgu5OOS7C-V12Zg_E7DYfufH8ua0RXOzJUnlynRTIrtwFBUQgGNz6nVeGOjgP7t4ydGEavNwmX1u5gfYIz8dCF6MaHUz4jBPWLkvcPXvmHdJWlR-XLzmujWfyL0_UFSGE97bDUf27SImbHFJjA"/>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Linda Kusuma</h3>
                    <p class="text-sm text-primary font-medium mb-2">Director of Admissions</p>
                </div>
                <!-- Profile 4 -->
                <div class="flex flex-col items-center text-center group">
                    <div class="relative mb-6 overflow-hidden rounded-full w-40 h-40 border-4 border-white dark:border-slate-700 shadow-lg">
                        <img alt="Portrait of James Nugraha" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAe14P606NyucHLWXqourQkc1-otHKy1bDZcriQnut4HTatixkqAWT-SZ6B1YzKWl0Lto-BQoBQbRIaDJaNSYk5kNGhPWcO0IGU6AEMxU4E5wMVFTJztjvSOyjwQ3Jg8D5jy_ifJ23tDvlAhDal1JeGgqBVEYbRXI0d4yX0sKidDN04lI-xu6OIMPwbUK7PWz-mA7BV1Evl_xg8jAUfzfj5u4F76CMqh62uZby1WjJRiMhTHSIOTb0kXIwDUdBrp_A9Ec6qUWT6g_0"/>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">James Nugraha</h3>
                    <p class="text-sm text-primary font-medium mb-2">Community Relations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Support / CTA Section Start -->
    <section class="py-20 bg-primary/5 dark:bg-slate-800/50">
        <div class="layout-container max-w-[960px] mx-auto px-4 text-center">
            <div class="flex flex-col items-center gap-6">
                <div class="w-16 h-16 bg-white dark:bg-slate-700 rounded-full flex items-center justify-center shadow-sm text-primary mb-2">
                    <span class="material-symbols-outlined text-4xl">calendar_month</span>
                </div>
                <h2 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black tracking-tight">
                    Experience the Difference
                </h2>
                <p class="text-slate-600 dark:text-slate-300 text-lg max-w-2xl mx-auto">
                    The best way to understand our vision is to see it in action. Schedule a campus tour or speak with our admissions team today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mt-4">
                    <button class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-12 px-6 bg-primary hover:bg-sky-500 text-white text-base font-bold shadow-md transition-colors">
                        Schedule a Visit
                    </button>
                    <button class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-12 px-6 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-600 text-base font-bold shadow-sm transition-colors">
                        Contact Admissions
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection