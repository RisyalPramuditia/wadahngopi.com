@extends('layouts.app')

@section('title', 'Profil - WadahNgopi.Com')

@section('content')
    <div class="min-h-screen bg-[--color-cream] relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="bg-blob bg-[--color-espresso] w-80 h-80 top-0 -right-20 opacity-[0.05]"></div>
        <div class="bg-blob bg-[--color-amber] w-64 h-64 top-1/2 -left-20 opacity-[0.03]"></div>

        {{-- Minimalist Header with Branding --}}
        <header class="px-6 pt-12 pb-4 relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl overflow-hidden p-1 bg-white shadow-premium border border-slate-50">
                    <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi Logo" class="w-full h-full object-cover">
                </div>
                <h1 class="text-xl font-black text-[--color-espresso] font-display">
                    Wadah<span class="text-[--color-amber]">Ngopi</span>
                </h1>
            </div>
        </header>

        {{-- Profile Header --}}
        <div class="px-6 py-12 text-center relative z-10 animate-up">
            <div class="relative inline-block mb-8 group">
                <div class="absolute inset-0 bg-[--color-amber] blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                <div class="relative w-36 h-36 bg-[--color-espresso] text-white rounded-[48px] flex items-center justify-center mx-auto shadow-premium border-4 border-white transform hover:rotate-6 transition-transform duration-500">
                    <i class="ph-fill ph-user-circle text-6xl"></i>
                </div>
            </div>

            <h1 class="text-3xl font-black text-[--color-espresso] font-display mb-2">Pecinta Kopi</h1>
            <p class="text-slate-400 font-bold text-[0.7rem] uppercase tracking-[0.2em] opacity-60">Verified Member since 2026</p>
        </div>

        {{-- About Section --}}
        <div class="m-6 relative z-10 animate-up" style="animation-delay: 0.15s">
            <div class="bg-white/80 backdrop-blur-xl border border-white p-10 rounded-[48px] shadow-premium">
                <h3 class="text-xl font-black text-[--color-espresso] mb-6 font-display flex items-center gap-3">
                    <span class="w-1.5 h-1.5 bg-[--color-amber] rounded-full"></span>
                    Visi WadahNgopi
                </h3>
                <p class="text-slate-500 leading-relaxed font-bold text-[0.92rem] opacity-90">
                    WadahNgopi.Com hadir sebagai navigasi visual dalam mencari pengalaman ngopi terbaik di Kalimantan. 
                    Kami menggabungkan kenyamanan teknologi dengan keaslian budaya ngopi lokal untuk menghadirkan kemudahan dalam satu genggaman.
                </p>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="px-10 mt-20 text-center relative z-10 opacity-30 animate-up" style="animation-delay: 0.3s">
            <div class="text-[0.6rem] font-black text-slate-400 tracking-[0.4em] uppercase mb-4">
                Designed for Curation
            </div>
            <div class="flex justify-center gap-2 text-slate-400 font-black text-[0.6rem] tracking-widest uppercase items-center">
                <span>V1.0.3</span>
                <span class="w-1 h-1 bg-slate-300 rounded-full mx-1"></span>
                <span>AK Kreatif</span>
            </div>
        </div>

        <div class="h-40"></div>
    </div>
@endsection