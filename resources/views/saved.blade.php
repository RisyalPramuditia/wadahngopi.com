@extends('layouts.app')

@section('title', 'Tersimpan - WadahNgopi.Com')

@section('content')
    <div x-data="{ 
            bookmarks: JSON.parse(localStorage.getItem('wadah-bookmarks') || '[]'),
            init() {
                const urlParams = new URLSearchParams(window.location.search);
                const urlIds = urlParams.getAll('ids[]');

                if (this.bookmarks.length > 0 && urlIds.length === 0) {
                    let query = this.bookmarks.map(id => `ids[]=${id}`).join('&');
                    window.location.href = `{{ route('saved') }}?${query}`;
                }
            },
            removeBookmark(id) {
                this.bookmarks = this.bookmarks.filter(b => b != id);
                localStorage.setItem('wadah-bookmarks', JSON.stringify(this.bookmarks));

                if (this.bookmarks.length === 0) {
                    window.location.href = `{{ route('saved') }}`;
                } else {
                    let query = this.bookmarks.map(id => `ids[]=${id}`).join('&');
                    window.location.href = `{{ route('saved') }}?${query}`;
                }
            }
        }" class="min-h-screen bg-[--color-cream] relative overflow-hidden">
        
        {{-- Decorative Background --}}
        <div class="bg-blob bg-[--color-amber] w-64 h-64 -top-10 -right-20 opacity-[0.05]"></div>
        
        {{-- Minimalist Header with Branding --}}
        <header class="px-6 pt-12 pb-4 relative z-10">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl overflow-hidden p-1 bg-white shadow-premium border border-slate-50">
                    <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi Logo" class="w-full h-full object-cover">
                </div>
                <h1 class="text-xl font-black text-[--color-espresso] font-display">
                    Wadah<span class="text-[--color-amber]">Ngopi</span>
                </h1>
            </div>

            <h2 class="text-2xl font-black text-[--color-espresso] font-display mb-1">Favorit Kamu</h2>
            <p x-show="bookmarks.length > 0" class="text-slate-400 font-bold text-[0.68rem] uppercase tracking-widest">
                Koleksi tempat nongkrong pilihan.
            </p>
        </header>

        <main class="px-6 pb-40 relative z-10">
            <div class="grid gap-4">
                @forelse($cafes as $index => $cafe)
                    <div class="group relative animate-up" style="animation-delay: {{ $index * 0.08 }}s">
                        <button @click.stop="removeBookmark({{ $cafe->id }})"
                            class="absolute top-3 right-3 w-9 h-9 rounded-xl bg-rose-50 hover:bg-rose-500 border border-rose-100 hover:border-rose-500 flex items-center justify-center text-rose-400 hover:text-white transition-all z-20 shadow-sm active:scale-90">
                            <i class="ph-fill ph-trash text-base"></i>
                        </button>

                        <a href="{{ route('cafes.show', $cafe) }}" class="flex items-center gap-4 p-3 bg-white rounded-3xl border border-slate-100 hover:border-slate-200 shadow-soft hover:shadow-premium transition-all duration-300 no-underline">
                            <div class="relative w-20 h-20 shrink-0 overflow-hidden rounded-2xl">
                                <img src="{{ $cafe->image_path && str_starts_with($cafe->image_path, 'http') ? $cafe->image_path : ($cafe->image_path ? Storage::url($cafe->image_path) : 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=800') }}"
                                    onerror="this.src='https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=800'"
                                    alt="{{ $cafe->name }}" class="w-full h-full object-cover aspect-square transition-transform duration-500 group-hover:scale-110" loading="lazy">
                                
                                {{-- Status Badge on Image --}}
                                <div class="absolute top-1.5 left-1.5">
                                    <span class="px-2 py-0.5 {{ $cafe->is_open ? 'bg-emerald-500/90 text-white' : 'bg-slate-500/90 text-white' }} backdrop-blur-sm rounded-md text-[0.6rem] font-black uppercase tracking-wider shadow-sm">
                                        {{ $cafe->is_open ? 'Buka' : 'Tutup' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex-1 min-w-0 pr-2">
                                <h3 class="font-black text-slate-900 text-base font-display mb-1 truncate group-hover:text-[--color-amber] transition-colors">{{ $cafe->name }}</h3>
                                <p class="text-slate-500 text-xs font-medium line-clamp-1 mb-2">{{ $cafe->address }}</p>
                                <div class="flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 rounded-lg border border-amber-100 w-fit">
                                    <i class="ph-fill ph-lightning text-[--color-amber] text-xs"></i>
                                    <span class="font-black text-[--color-espresso] text-[0.65rem]">{{ number_format($cafe->total_energy) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-32 animate-up">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-premium border border-slate-100">
                            <i class="ph-fill ph-heart-break text-4xl text-slate-300"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 font-display mb-3">Belum Ada Favorit</h3>
                        <p class="text-sm font-medium text-slate-500 leading-relaxed px-8 mb-10 max-w-xs mx-auto">
                            Mulai jelajahi dan simpan cafe favorit kamu sekarang!
                        </p>
                        <a href="{{ route('explore') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[--color-espresso] text-white rounded-2xl font-black text-sm uppercase tracking-wider shadow-lg hover:shadow-xl transition-all active:scale-95 no-underline">
                            <i class="ph-fill ph-compass text-lg"></i>
                            <span>Cari Cafe Sekarang</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
@endsection