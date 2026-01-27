@extends('layouts.app')

@section('title', $cafe->name . ' - WadahNgopi.Com')

@php
    use Illuminate\Support\Facades\Storage;

    $rawImages = collect([$cafe->image_path])
        ->merge($cafe->images ?? [])
        ->filter()
        ->map(function ($img) {
            return str_starts_with($img, 'http') ? $img : Storage::url($img);
        })
        ->values()
        ->all();

    $galleryImages = empty($rawImages)
        ? ['https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&q=80&w=1200']
        : $rawImages;
@endphp

@section('content')
    <div class="detail-wrapper" x-data="cafeDetailComponent({
        id: {{ $cafe->id }},
        totalEnergy: {{ $cafe->total_energy }},
        images: {{ json_encode($galleryImages) }}
    })">

        {{-- Hero Slider Section --}}
        <div class="detail-hero-luxury relative aspect-[4/5] overflow-hidden" @touchstart="touchStart($event)" @touchend="touchEnd($event)">
            {{-- Nav Overlay --}}
            <nav class="absolute top-8 left-0 right-0 z-50 px-6 flex justify-between items-center">
                <a href="javascript:history.back()" class="w-12 h-12 rounded-full bg-black/10 backdrop-blur-2xl border border-white/20 flex items-center justify-center text-white shadow-glass transition-all active:scale-90 no-underline">
                    <i class="ph ph-arrow-left text-2xl"></i>
                </a>
                <div class="flex gap-3">
                    <button @click="shareCafe('{{ $cafe->name }}', '{{ route('cafes.show', $cafe) }}')" class="w-12 h-12 rounded-full bg-black/10 backdrop-blur-2xl border border-white/20 flex items-center justify-center text-white shadow-glass transition-all active:scale-90">
                        <i class="ph ph-share-network text-2xl"></i>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-black/10 backdrop-blur-2xl border border-white/20 flex items-center justify-center text-white shadow-glass transition-all active:scale-90" @click="toggleBookmark">
                        <i :class="isBookmarked ? 'ph-fill ph-bookmark-simple' : 'ph ph-bookmark-simple'"
                            :style="isBookmarked ? 'color: #F59E0B' : ''" class="text-2xl"></i>
                    </button>
                </div>
            </nav>

            {{-- Slider Images --}}
            <template x-for="(img, idx) in images" :key="idx">
                <div x-show="currentSlide === idx" x-transition:enter="transition duration-1000 ease-out"
                    x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                    class="absolute inset-0">
                    <img :src="img" 
                        onerror="this.src='https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&q=80&w=1200'"
                        class="w-full h-full object-cover" alt="Cafe">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                </div>
            </template>

            {{-- Slider Info Overlay --}}
            <div class="absolute bottom-12 left-6 right-6 z-20">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 bg-white/10 backdrop-blur-md border border-white/20 rounded-lg text-[0.65rem] font-black tracking-widest uppercase text-white">
                        # TERPOPULER
                    </span>
                    <span class="px-3 py-1 {{ $cafe->is_open ? 'bg-emerald-500/20 text-emerald-300' : 'bg-rose-500/20 text-rose-300' }} backdrop-blur-md border border-white/10 rounded-lg text-[0.65rem] font-black tracking-widest uppercase flex items-center gap-2">
                        <span>{{ $cafe->is_open ? 'BUKA' : 'TUTUP' }}</span>
                        @if($cafe->opening_time && $cafe->closing_time)
                            <span class="w-1 h-1 rounded-full bg-current opacity-50"></span>
                            <span>{{ \Carbon\Carbon::parse($cafe->opening_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($cafe->closing_time)->format('H:i') }}</span>
                        @endif
                    </span>
                </div>
                <h1 class="text-4xl font-black text-white leading-tight font-display mb-3">{{ $cafe->name }}</h1>
                <div class="flex items-center gap-2 text-white/70 font-bold text-xs uppercase tracking-wider">
                    <i class="ph-fill ph-map-pin text-[--color-amber] text-lg"></i>
                    <span>{{ $cafe->address }}</span>
                </div>
            </div>

            {{-- Dot Indicators --}}
            <div class="absolute bottom-6 left-6 flex gap-1.5 z-30">
                <template x-for="(_, idx) in images" :key="idx">
                    <div class="h-1 rounded-full transition-all duration-700" 
                        :class="currentSlide === idx ? 'w-10 bg-[--color-amber]' : 'w-2 bg-white/30'"
                        @click="currentSlide = idx"></div>
                </template>
            </div>
        </div>

        {{-- Main Detail Content --}}
        <div class="bg-[--color-cream] -mt-8 relative z-40 rounded-t-[40px] px-6 pt-10 pb-40 animate-up">
            {{-- Action Buttons --}}
            <div class="mb-12 space-y-4">
                @if($cafe->google_maps_url)
                    <a href="{{ $cafe->google_maps_url }}" target="_blank" class="block w-full px-4 py-5 bg-[--color-espresso] text-white rounded-3xl flex items-center justify-center gap-3 shadow-premium transition-all active:scale-95 no-underline">
                        <i class="ph-fill ph-navigation-arrow text-xl"></i>
                        <span class="text-[0.7rem] font-black uppercase tracking-[0.15em]">Rute Sekarang</span>
                    </a>
                @endif

                <div class="grid grid-cols-2 gap-3">
                    @if($cafe->instagram_url)
                        <a href="{{ $cafe->instagram_url }}" target="_blank" class="px-4 py-4 bg-white border border-slate-100 text-[--color-espresso] rounded-2xl flex items-center justify-center gap-2 shadow-soft transition-all active:scale-95 no-underline">
                            <i class="ph-fill ph-instagram-logo text-xl text-rose-500"></i>
                            <span class="text-[0.65rem] font-black uppercase tracking-wider">Instagram</span>
                        </a>
                    @endif
                    
                    @if($cafe->tiktok_url)
                        <a href="{{ $cafe->tiktok_url }}" target="_blank" class="px-4 py-4 bg-white border border-slate-100 text-[--color-espresso] rounded-2xl flex items-center justify-center gap-2 shadow-soft transition-all active:scale-95 no-underline">
                            <i class="ph-fill ph-tiktok-logo text-xl text-black"></i>
                            <span class="text-[0.65rem] font-black uppercase tracking-wider">TikTok</span>
                        </a>
                    @endif

                    @if($cafe->whatsapp_number)
                        <a href="https://wa.me/{{ $cafe->whatsapp_number }}" target="_blank" class="px-4 py-4 bg-white border border-slate-100 text-[--color-espresso] rounded-2xl flex items-center justify-center gap-2 shadow-soft transition-all active:scale-95 no-underline">
                            <i class="ph-fill ph-whatsapp-logo text-xl text-[#25D366]"></i>
                            <span class="text-[0.65rem] font-black uppercase tracking-wider">WhatsApp</span>
                        </a>
                    @endif
                </div>

            {{-- Description --}}
            <div class="mb-12">
                <p class="text-slate-500 leading-relaxed font-bold text-[0.95rem] opacity-90 first-letter:text-4xl first-letter:font-black first-letter:text-[--color-espresso] first-letter:mr-3 first-letter:float-left">
                    {{ $cafe->description }}
                </p>
                <div class="clear-both"></div>
            </div>

            {{-- Features Section --}}
            <section class="mb-14">
                <h2 class="text-xl font-black text-[--color-espresso] mb-6 flex items-center gap-3 font-display">
                    <span class="w-1.5 h-1.5 bg-[--color-amber] rounded-full"></span>
                    Fasilitas Tersedia
                </h2>
                <div class="grid grid-cols-2 gap-3">
                    @forelse($cafe->facilities as $f)
                        <div class="bg-white border border-slate-100 p-4 rounded-3xl flex items-center gap-4 transition-all hover:bg-slate-50 shadow-soft">
                            <div class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-[--color-coffee-dark]">
                                <i class="{{ $f->icon ?? 'ph-fill ph-check-circle' }} text-xl"></i>
                            </div>
                            <span class="font-black text-[--color-espresso] text-[0.75rem] uppercase tracking-wide">{{ $f->name }}</span>
                        </div>
                    @empty
                        <span class="text-slate-300 italic text-sm">Informasi fasilitas belum tersedia.</span>
                    @endforelse
                </div>
            </section>

            {{-- Menu Section --}}
            <section class="mb-14">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-black text-[--color-espresso] font-display">Eksplorasi Rasa</h2>
                    <div class="flex gap-2 p-1 bg-slate-100 rounded-2xl">
                        <template x-for="t in ['coffee', 'food', 'non-coffee']">
                            <button @click="currentTab = t" 
                                class="px-4 py-2 rounded-xl text-[0.6rem] font-black uppercase tracking-widest transition-all"
                                :class="currentTab === t ? 'bg-white text-[--color-espresso] shadow-sm' : 'text-slate-400'">
                                <span x-text="t === 'non-coffee' ? 'Non' : t"></span>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Menu List --}}
                <div class="grid gap-4">
                    @forelse($cafe->menus as $menu)
                        <div class="bg-white rounded-3xl p-4 shadow-soft hover:shadow-premium transition-all duration-300 group" x-show="currentTab === '{{ $menu->type }}'"
                            x-transition:enter="transition duration-300 transform"
                            x-transition:enter-start="opacity-0 translate-y-3"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            
                            <div class="flex items-start gap-4">
                                <div class="relative w-24 h-24 rounded-2xl overflow-hidden shadow-soft flex-shrink-0">
                                    <img src="{{ $menu->image_path && str_starts_with($menu->image_path, 'http') ? $menu->image_path : ($menu->image_path ? Storage::url($menu->image_path) : 'https://images.unsplash.com/photo-1541167760496-162955ed8a9f?w=200') }}" 
                                        class="w-full h-full object-cover aspect-square transition-transform duration-500 group-hover:scale-110" 
                                        alt="{{ $menu->name }}">
                                </div>

                                <div class="flex-1 flex flex-col justify-center py-1">
                                    <h4 class="font-black text-[--color-espresso] text-[1.05rem] mb-1 font-display leading-tight line-clamp-1">{{ $menu->name }}</h4>
                                    <p class="text-[0.7rem] text-slate-400 font-medium mb-2 line-clamp-2 leading-relaxed">{{ $menu->description }}</p>
                                    <div class="font-black text-[--color-amber] text-base uppercase tracking-tight">IDR {{ number_format($menu->price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-slate-50 rounded-[40px] border border-dashed border-slate-200">
                            <span class="text-slate-400 font-bold text-xs uppercase tracking-widest">Belum ada menu tersedia</span>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- Support Section (Minimalist Professional) --}}
            <section class="mb-14">
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-soft flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-[--color-amber] flex-shrink-0">
                            <i class="ph-fill ph-heart text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-[--color-espresso] text-sm font-display mb-0.5">Suka Cafe Ini?</h3>
                            <p class="text-xs text-slate-400 font-medium">Berikan dukungan energi</p>
                        </div>
                    </div>

                    <button @click="addEnergy" class="flex items-center gap-2 px-4 py-2.5 bg-[--color-espresso] text-white rounded-xl shadow-md active:scale-95 transition-all">
                        <i class="ph-fill ph-lightning text-amber-400"></i>
                        <span class="text-xs font-black uppercase tracking-wider" x-text="formatNumber(totalEnergy)"></span>
                    </button>
                </div>
            </section>

            <div class="h-24"></div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cafeDetailComponent', (props) => ({
                currentSlide: 0,
                currentTab: 'coffee',
                images: props.images,
                isBookmarked: false,
                totalEnergy: props.totalEnergy,
                pendingSync: 0,
                isBouncing: false,
                particles: [],
                visitorId: '',
                syncTimer: null,
                tx: 0,

                init() {
                    let vid = localStorage.getItem('wadah-visitor-id');
                    if (!vid) {
                        vid = 'visitor-' + Math.random().toString(36).substr(2, 9) + Date.now();
                        localStorage.setItem('wadah-visitor-id', vid);
                    }
                    this.visitorId = vid;

                    const saved = JSON.parse(localStorage.getItem('wadah-bookmarks') || '[]');
                    this.isBookmarked = saved.includes(props.id);
                    
                    setInterval(() => { this.nextSlide(); }, 6000);

                    window.addEventListener('beforeunload', () => {
                        if (this.pendingSync > 0) this.syncEnergy();
                    });
                },

                nextSlide() { this.currentSlide = (this.currentSlide + 1) % this.images.length; },
                prevSlide() { this.currentSlide = (this.currentSlide - 1 + this.images.length) % this.images.length; },

                touchStart(e) { this.tx = e.touches[0].clientX; },
                touchEnd(e) {
                    const dx = this.tx - e.changedTouches[0].clientX;
                    if (Math.abs(dx) > 40) { dx > 0 ? this.nextSlide() : this.prevSlide(); }
                },

                toggleBookmark() {
                    let b = JSON.parse(localStorage.getItem('wadah-bookmarks') || '[]');
                    this.isBookmarked ? b = b.filter(id => id !== props.id) : b.push(props.id);
                    localStorage.setItem('wadah-bookmarks', JSON.stringify(b));
                    this.isBookmarked = !this.isBookmarked;
                },

                addEnergy() {
                    this.totalEnergy++;
                    this.pendingSync++;

                    clearTimeout(this.syncTimer);
                    this.syncTimer = setTimeout(() => { this.syncEnergy(); }, 1500);
                },

                async syncEnergy() {
                    if (this.pendingSync === 0) return;
                    const count = this.pendingSync;
                    this.pendingSync = 0;

                    try {
                        const r = await fetch('{{ route('cafes.energy', $cafe) }}', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ energy_count: count, visitor_id: this.visitorId })
                        });
                        const d = await r.json();
                        if (d.new_total > this.totalEnergy) this.totalEnergy = d.new_total;
                    } catch (e) {
                        this.pendingSync += count;
                    }
                },

                formatNumber(n) {
                    return new Intl.NumberFormat('id-ID').format(n);
                },

                triggerHaptic() {
                    if (window.navigator.vibrate) window.navigator.vibrate(10);
                },

                async shareCafe(title, url) {
                    this.triggerHaptic();
                    if (navigator.share) {
                        try {
                            await navigator.share({
                                title: title,
                                text: 'Cek tempat ngopi estetik ini di WadahNgopi: ' + title,
                                url: url
                            });
                        } catch (err) {
                            console.log('Share canceled');
                        }
                    } else {
                        // Fallback
                        await navigator.clipboard.writeText(url);
                        alert('Link cafe berhasil disalin!');
                    }
                }
            }));
        });
    </script>
@endsection