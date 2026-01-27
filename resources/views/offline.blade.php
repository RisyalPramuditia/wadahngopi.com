@extends('layouts.app')

@section('title', 'Offline - WadahNgopi')

@section('content')
    <div class="min-h-screen bg-[--color-cream] flex flex-col items-center justify-center px-8 text-center">
        <div class="relative mb-10">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-premium animate-bounce-slow">
                <i class="ph-fill ph-wifi-slash text-4xl text-slate-300"></i>
            </div>
            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white shadow-lg border-2 border-[--color-cream]">
                <i class="ph-bold ph-warning"></i>
            </div>
        </div>

        <h1 class="text-2xl font-black text-slate-900 font-display mb-4 tracking-tighter">
            Waduh, Sinyal Hilang!
        </h1>
        
        <p class="text-sm font-bold text-slate-500 leading-relaxed max-w-[280px] mb-12 opacity-80">
            Sepertinya buanmu sedang offline. Coba cek koneksi internetmu dulu ya.
        </p>

        <button onclick="window.location.reload()" class="w-full max-w-[240px] py-4 bg-[--color-espresso] text-white rounded-2xl font-black text-xs tracking-[0.2em] uppercase shadow-xl hover:bg-black transition-all active:scale-95">
            COBA LAGI <i class="ph-bold ph-arrows-clockwise ml-2"></i>
        </button>

        <div class="mt-16 flex items-center gap-3 opacity-30 grayscale">
            <div class="w-6 h-6 rounded-lg overflow-hidden border border-slate-300">
                <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi" class="w-full h-full object-cover">
            </div>
            <span class="text-[0.5rem] font-black tracking-[0.4em] uppercase">WadahNgopi PWA</span>
        </div>
    </div>
@endsection
