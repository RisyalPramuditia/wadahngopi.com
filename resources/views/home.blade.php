@extends('layouts.app')

@section('title', 'WadahNgopi - Portal Cafe Kalimantan')

@section('content')
    <div class="landing-page min-h-screen relative overflow-hidden">
        {{-- Decorative Background Blobs --}}
        <div class="bg-blob bg-[--color-amber] w-72 h-72 -top-20 -right-20 opacity-[0.07]"></div>
        <div class="bg-blob bg-[--color-espresso] w-96 h-96 top-1/2 -left-32 opacity-[0.05]"></div>

        {{-- Branding Hero --}}
        <header class="relative z-10 px-6 pt-16 pb-12 text-center animate-up">
            <div
                class="inline-flex items-center gap-1.5 px-3 py-1 bg-white shadow-soft border border-slate-50 rounded-lg mb-10">
                <span class="text-[0.6rem] font-black text-slate-300">#</span>
                <span class="text-[0.62rem] font-black text-slate-800 tracking-[0.2em] uppercase">AK Kreatif</span>
            </div>

            <div class="flex items-center justify-center gap-4 mb-6">
                <div
                    class="w-16 h-16 rounded-[24px] overflow-hidden p-1.5 bg-white shadow-premium border border-slate-50 transform -rotate-2 hover:rotate-0 transition-transform duration-700">
                    <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi Logo"
                        class="w-full h-full object-cover">
                </div>
                <h1 class="text-4xl font-black text-[--color-espresso] leading-[1] tracking-tighter font-display">
                    Wadah<span class="text-[--color-amber]">Ngopi</span>
                </h1>
            </div>

            <p class="text-slate-600 font-bold text-[0.95rem] leading-relaxed max-w-[280px] mx-auto mb-10 opacity-90">
                Mempermudah buanmu mencari spot ngopi nyaman di Kalimantan.
            </p>
        </header>

        {{-- Brand Philosophy Section --}}
        <section class="relative z-10 px-8 py-8 flex flex-col gap-5 bg-slate-50/40 -mx-8 px-8 mb-6">
            <div class="text-center mb-2">
                <h2 class="text-2xl font-black text-[--color-espresso] tracking-tighter">Tentang <span
                        class="text-[--color-amber]">Kami</span></h2>
                <div class="w-12 h-1 bg-amber-500 mx-auto mt-2 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                {{-- Philosophy 1 --}}
                <div class="p-5 bg-white rounded-3xl shadow-soft border border-slate-50">
                    <div class="w-10 h-10 bg-amber-100 flex items-center justify-center rounded-2xl mb-3 text-amber-600">
                        <i class="ph-fill ph-hand-heart text-2xl"></i>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1.5">Lebih dari Sekadar Kopi</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-bold">
                        Di WadahNgopi, secangkir kopi adalah awal kolaborasi. Kami bukan sekadar tempat singgah, melainkan
                        ruang untuk merajut silaturahmi dan menyatukan ide para pelaku usaha. Setiap meja adalah peluang
                        bagi buanmu untuk tumbuh dan maju bersama.
                    </p>
                </div>

                {{-- Philosophy 2 --}}
                <div class="p-5 bg-white rounded-3xl shadow-soft border border-slate-50">
                    <div
                        class="w-10 h-10 bg-espresso-100 flex items-center justify-center rounded-2xl mb-3 text-[--color-espresso]">
                        <i class="ph-fill ph-users-three text-2xl"></i>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1.5">Harmoni Komunitas</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-bold">
                        Setiap "Wadah" punya cerita. Kami hadir untuk memastikan setiap cerita lokal di Kalimantan terdengar
                        dan diapresiasi oleh buanmu semua.
                    </p>
                </div>

                {{-- Philosophy 3 --}}
                <div class="p-5 bg-white rounded-3xl shadow-soft border border-slate-50">
                    <div class="w-10 h-10 bg-slate-100 flex items-center justify-center rounded-2xl mb-3 text-slate-600">
                        <i class="ph-fill ph-leaf text-2xl"></i>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1.5">Kearifan Lokal</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-bold">
                        WadahNgopi hadir untuk menghangatkan buanmu dengan spot kopi terbaik.
                    </p>
                </div>
            </div>
        </section>

        {{-- Connect / Social Luxury Card --}}
        <section class="relative z-10 px-6 pb-16 -mt-8">
            <div class="mission-luxury-card">
                {{-- Decorative Background --}}
                <div class="absolute -right-20 -bottom-20 opacity-[0.04] pointer-events-none">
                    <i class="ph-fill ph-coffee-bean text-[24rem] rotate-12"></i>
                </div>

                <div class="relative z-20 flex flex-col items-center">
                    <div class="grid grid-cols-2 gap-3 w-full">
                        {{-- Instagram --}}
                        <a href="https://instagram.com/wadahngopi" target="_blank"
                            class="flex flex-col items-center justify-center p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-[2.5rem] no-underline group active:scale-95 transition-all">
                            <i
                                class="ph-fill ph-instagram-logo text-3xl text-white/80 group-hover:text-amber-500 transition-colors"></i>
                            <span
                                class="text-[0.55rem] font-black text-white/30 mt-3 tracking-[0.2em] uppercase">Instagram</span>
                        </a>

                        {{-- TikTok --}}
                        <a href="https://tiktok.com/@wadahngopi" target="_blank"
                            class="flex flex-col items-center justify-center p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-[2.5rem] no-underline group active:scale-95 transition-all">
                            <i
                                class="ph-fill ph-tiktok-logo text-3xl text-white/80 group-hover:text-amber-500 transition-colors"></i>
                            <span
                                class="text-[0.55rem] font-black text-white/30 mt-3 tracking-[0.2em] uppercase">TikTok</span>
                        </a>

                        {{-- YouTube --}}
                        <a href="https://youtube.com/@wadahngopi" target="_blank"
                            class="flex flex-col items-center justify-center p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-[2.5rem] no-underline group active:scale-95 transition-all">
                            <i
                                class="ph-fill ph-youtube-logo text-3xl text-white/80 group-hover:text-amber-500 transition-colors"></i>
                            <span
                                class="text-[0.55rem] font-black text-white/30 mt-3 tracking-[0.2em] uppercase">YouTube</span>
                        </a>

                        {{-- WhatsApp --}}
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="flex flex-col items-center justify-center p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-[2.5rem] no-underline group active:scale-95 transition-all">
                            <i
                                class="ph-fill ph-whatsapp-logo text-3xl text-white/80 group-hover:text-amber-500 transition-colors"></i>
                            <span
                                class="text-[0.55rem] font-black text-white/30 mt-3 tracking-[0.2em] uppercase">WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        {{-- Main Features Section --}}
        <section class="relative z-10 px-8 py-10 flex flex-col gap-10">
            <div class="text-center">
                <h2 class="text-2xl font-black text-[--color-espresso] tracking-tighter">Fitur <span
                        class="text-[--color-amber]">Unggulan</span></h2>
                <div class="w-12 h-1 bg-amber-500 mx-auto mt-2 rounded-full"></div>
            </div>

            <div class="flex flex-col gap-4">
                {{-- Card 1 --}}
                <div class="p-5 bg-white rounded-3xl shadow-soft border border-slate-50 hover:scale-[1.02] transition-transform duration-300"
                    style="animation-delay: 0.1s">
                    <div class="w-10 h-10 bg-amber-100 flex items-center justify-center rounded-2xl mb-3 text-amber-600">
                        <i class="ph-bold ph-navigation-arrow text-xl"></i>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1.5">Cari Nyaman Banget</h4>
                    <p class="text-[0.7rem] text-slate-500 leading-relaxed font-bold">
                        Cek lokasi paling parak real-time pake Google Maps!
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="p-5 bg-white rounded-3xl shadow-soft border border-slate-50 hover:scale-[1.02] transition-transform duration-300"
                    style="animation-delay: 0.2s">
                    <div
                        class="w-10 h-10 bg-espresso-100 flex items-center justify-center rounded-2xl mb-3 text-[--color-espresso]">
                        <i class="ph-bold ph-newspaper text-xl"></i>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1.5">Info Jelas & Lengkap</h4>
                    <p class="text-[0.7rem] text-slate-500 leading-relaxed font-bold">
                        Fasilitas, menu, sampai jam buka ada barataan.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="p-5 bg-white rounded-3xl shadow-soft border border-slate-50 hover:scale-[1.02] transition-transform duration-300"
                    style="animation-delay: 0.3s">
                    <div class="w-10 h-10 bg-amber-100 flex items-center justify-center rounded-2xl mb-3 text-amber-600">
                        <i class="ph-fill ph-bookmark-simple text-xl"></i>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1.5">Simpan Wadah Favorit</h4>
                    <p class="text-[0.7rem] text-slate-500 leading-relaxed font-bold">
                        Simpan yang buanmu suka biar gampang dicari lagi.
                    </p>
                </div>
            </div>
        </section>

        {{-- Primary Pill CTA Button (Amber Glass-Outline) --}}
        <div class="relative z-10 px-8 py-16 text-center">
            <a href="{{ route('explore') }}" class="primary-pill-btn">
                JELAJAH
            </a>
        </div>


        {{-- Custom PWA Install Banner --}}
        <div x-data="{ show: false, deferredPrompt: null }" x-init="
                                            window.addEventListener('beforeinstallprompt', (e) => {
                                                e.preventDefault();
                                                deferredPrompt = e;
                                                show = true;
                                            });
                                            window.addEventListener('appinstalled', () => {
                                                show = false;
                                            });
                                            // Logic for iOS (Safari)
                                            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
                                            const isStandalone = window.navigator.standalone === true;
                                            if (isIOS && !isStandalone) {
                                                show = true;
                                            }
                                         }" x-show="show" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            class="fixed bottom-32 left-6 right-6 z-[9999] p-6 bg-[--color-espresso] rounded-[32px] shadow-2xl border border-white/10">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl overflow-hidden bg-white p-1 flex-shrink-0 animate-bounce-slow">
                    <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-black text-white mb-1">Pasang WadahNgopi</h4>
                    <p class="text-[0.65rem] text-white/60 font-medium leading-tight">
                        Akses lebih cepat & hemat kuota. Tambahkan ke layar utama buanmu!
                    </p>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <template x-if="deferredPrompt">
                    <button
                        @click="deferredPrompt.prompt(); deferredPrompt.userChoice.then((r) => { if(r.outcome === 'accepted') show = false; })"
                        class="flex-1 py-3 bg-amber-500 text-white rounded-xl text-[0.65rem] font-black uppercase tracking-widest shadow-lg shadow-amber-500/20 active:scale-95 transition-all">
                        INSTALL SEKARANG
                    </button>
                </template>
                <template x-if="!deferredPrompt">
                    <div
                        class="flex-1 py-3 bg-white/5 text-white/40 rounded-xl text-[0.6rem] font-black uppercase tracking-widest text-center border border-white/10">
                        Tap <i class="ph-bold ph-export mx-1"></i> lalu 'Add to Home Screen'
                    </div>
                </template>
                <button @click="show = false"
                    class="px-4 py-3 bg-white/10 text-white rounded-xl text-[0.65rem] font-bold active:scale-95 transition-all">
                    NANTI SAJA
                </button>
            </div>
        </div>

        {{-- Footer Branding --}}
        <footer class="relative z-10 px-6 pb-48 text-center mt-10">
            <div class="text-[0.6rem] font-black text-slate-300 tracking-[0.4em] uppercase mb-4 opacity-50 font-display">
                WADAHNGOPI.COM &copy; 2026
            </div>
        </footer>
    </div>
@endsection