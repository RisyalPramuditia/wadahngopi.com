@extends('layouts.app')

@section('title', 'Informasi & Berita - WadahNgopi.Com')

@section('content')
    <div x-data="{ 
        selectedCategory: 'Semua',
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            });
        }
    }" class="min-h-screen bg-[--color-cream] relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="bg-blob bg-[--color-amber] w-72 h-72 -top-10 -right-20 opacity-[0.05] -z-10"></div>
        <div class="bg-blob bg-[--color-espresso] w-80 h-80 top-1/2 -left-20 opacity-[0.03] -z-10"></div>

        {{-- Sticky Glass Header --}}
        <header class="sticky top-0 z-50 transition-all duration-300"
            :class="scrolled ? 'bg-[--color-cream]/80 backdrop-blur-md shadow-sm' : 'bg-transparent'">
            <div class="px-6 pt-16 pb-4 transition-all duration-300"
                :class="scrolled ? 'pt-6' : 'pt-16'">
                
                {{-- Branding Integration --}}
                <div class="flex items-center gap-3 mb-6 transition-all duration-300"
                    :class="scrolled ? 'scale-90 origin-left opacity-0 h-0 my-0' : 'opacity-100'">
                    <div class="w-12 h-12 rounded-2xl overflow-hidden p-1 bg-white shadow-premium border border-slate-50 transform -rotate-2">
                        <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[0.55rem] font-black text-amber-600 tracking-[0.3em] uppercase">Portal Resmi</span>
                        <h2 class="text-xl font-black text-[--color-espresso] tracking-tighter leading-none">Wadah<span class="text-amber-500">Ngopi</span></h2>
                    </div>
                </div>

                <div class="flex items-center gap-3 mb-2">
                    <h1 class="font-black text-[--color-espresso] font-display transition-all duration-300"
                        :class="scrolled ? 'text-2xl' : 'text-3xl'">
                        Pembaruan & Tips
                    </h1>
                    <div class="w-8 h-8 flex items-center justify-center bg-[--color-amber] rounded-lg text-white animate-bounce-slow">
                        <i class="ph-fill ph-coffee-bean"></i>
                    </div>
                </div>
                <p class="text-slate-400 font-bold text-[0.68rem] uppercase tracking-widest">
                    Informasi seputar kopi di Kalimantan.
                </p>
            </div>

            {{-- Horizontal Category Filter --}}
            <div class="px-6 pb-4 overflow-x-auto scrollbar-hide">
                <div class="flex gap-2 min-w-max">
                    @foreach(['Semua', 'Berita', 'Edukasi', 'Lomba'] as $category)
                        <button @click="selectedCategory = '{{ $category }}'"
                            class="px-4 py-2 rounded-full font-black text-xs uppercase tracking-wider transition-all active:scale-95"
                            :class="selectedCategory === '{{ $category }}' 
                                ? 'bg-[--color-amber] text-white shadow-md' 
                                : 'bg-white text-slate-600 border border-slate-200 hover:border-[--color-amber]'">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>
        </header>

        {{-- News Feed --}}
        <main class="px-6 pb-32 relative z-10">
            <div class="grid gap-4 mt-4">
                @forelse($informations as $index => $info)
                    <a href="{{ route('information.show', $info->slug) }}" 
                        x-show="selectedCategory === 'Semua' || selectedCategory === '{{ $info->category ?? 'Berita' }}'"
                        x-transition:enter="transition duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="group block bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden active:scale-95 animate-up no-underline" 
                        style="animation-delay: {{ $index * 0.08 }}s">
                        
                        @if($info->image_path)
                            <div class="w-full aspect-video overflow-hidden">
                                <img src="{{ str_starts_with($info->image_path, 'http') ? $info->image_path : Storage::url($info->image_path) }}" 
                                     onerror="this.src='https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&q=80&w=800'"
                                     alt="{{ $info->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif

                        <div class="p-5">
                            {{-- Inline Category & Date --}}
                            <div class="flex items-center gap-2 mb-3 text-xs font-bold">
                                <span class="px-2.5 py-1 bg-amber-50 text-[--color-amber] rounded-lg uppercase tracking-wider">
                                    {{ $info->category ?? 'Berita' }}
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="text-slate-400">
                                    {{ $info->published_at ? $info->published_at->format('d M Y') : $info->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-lg font-black text-slate-900 font-display mb-2 leading-tight group-hover:text-[--color-amber] transition-colors line-clamp-2">
                                {{ $info->title }}
                            </h3>
                            <p class="text-slate-500 text-sm font-medium leading-relaxed line-clamp-2">
                                {{ $info->summary ?? Str::limit(strip_tags($info->content), 100) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-32 animate-up">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-premium border border-slate-100">
                            <i class="ph-fill ph-newspaper-clipping text-3xl text-slate-300"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 font-display mb-2">Belum Ada Berita</h3>
                        <p class="text-sm font-medium text-slate-500 leading-relaxed">
                            Kembali lagi nanti untuk info terbaru!
                        </p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
@endsection
