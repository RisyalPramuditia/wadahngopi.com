@extends('layouts.app')

@section('title', 'Jelajah - WadahNgopi.Com')

@section('content')
    <div x-data="exploreLogic()" x-init="initComponent()" class="min-h-screen bg-[--color-cream] relative overflow-hidden">
        {{-- Decorative Background Blobs --}}
        <div class="bg-blob bg-[--color-amber] w-64 h-64 -top-10 -right-20 opacity-[0.05]"></div>
        <div class="bg-blob bg-[--color-espresso] w-80 h-80 top-1/3 -left-24 opacity-[0.03]"></div>

        {{-- Minimalist Header with Branding --}}
        <header class="px-6 pt-12 pb-4 relative z-10">
            <div class="flex items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl overflow-hidden p-1 bg-white shadow-premium border border-slate-50">
                        <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi Logo"
                            class="w-full h-full object-cover">
                    </div>
                    <h1 class="text-xl font-black text-[--color-espresso] font-display">
                        Wadah<span class="text-[--color-amber]">Ngopi</span>
                    </h1>
                </div>

                {{-- Feature Guide Indicator (Simple & Pro) --}}
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[--color-amber] animate-pulse"></span>
                    <span class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-widest">Live Explore</span>
                </div>
            </div>

            <div class="search-luxury-box mb-6">
                <i class="ph-bold ph-magnifying-glass text-[--color-amber] text-lg"></i>
                <input type="text" x-model="search" placeholder="Cari café idamanmu..." @keyup.escape="search = ''"
                    class="font-display">
            </div>

            {{-- Professional Horizontal Filter Bar --}}
            <div class="relative">
                <div class="flex items-center gap-3 overflow-x-auto no-scrollbar py-2 -mx-2 px-2 snap-x" data-no-swipe>
                    <button @click="activeFilter = 'semua'; selectedLetter = null"
                        class="flex-shrink-0 px-6 py-2.5 rounded-full text-[0.65rem] font-black uppercase tracking-widest transition-all active:scale-95 snap-start shadow-sm"
                        :class="activeFilter === 'semua' && !selectedLetter ? 'bg-[--color-espresso] text-white' : 'bg-white text-slate-400 border border-gray-100'">
                        Semua
                    </button>

                    <button @click="activeFilter = 'terdekat'; getLocation(); selectedLetter = null"
                        class="flex-shrink-0 px-5 py-2.5 rounded-full text-[0.65rem] font-black uppercase tracking-widest transition-all active:scale-95 snap-start flex items-center gap-2 shadow-sm"
                        :class="activeFilter === 'terdekat' ? 'bg-[--color-espresso] text-white' : 'bg-white text-slate-400 border border-gray-100'">
                        <i class="ph-bold ph-map-pin" x-show="!isLocating"></i>
                        <i class="ph-bold ph-circle-notch animate-spin" x-show="isLocating"></i>
                        <span>Terdekat</span>
                    </button>

                    <button @click="activeFilter = 'buka'; selectedLetter = null"
                        class="flex-shrink-0 px-6 py-2.5 rounded-full text-[0.65rem] font-black uppercase tracking-widest transition-all active:scale-95 snap-start shadow-sm"
                        :class="activeFilter === 'buka' ? 'bg-[--color-espresso] text-white' : 'bg-white text-slate-400 border border-gray-100'">
                        Buka
                    </button>

                    {{-- A-Z Integration - Multi-Select Minimalist --}}
                    <div class="flex-shrink-0">
                        <button
                            @click="activeFilter = (activeFilter === 'az' && selectedLetters.length === 0) ? 'semua' : 'az'"
                            class="px-5 py-2.5 rounded-full text-[0.65rem] font-black uppercase tracking-widest transition-all active:scale-95 flex items-center gap-2 shadow-sm"
                            :class="(activeFilter === 'az' || selectedLetters.length > 0) ? 'bg-[--color-espresso] text-white' : 'bg-white text-slate-400 border border-gray-100'">
                            <i class="ph-bold ph-sort-ascending text-lg"></i>
                            <span
                                x-text="selectedLetters.length > 0 ? 'Abjad (' + selectedLetters.length + ')' : 'A-Z'"></span>
                        </button>
                    </div>
                </div>

                {{-- Global Alphabet Navigator (Multi-Select Minimalist) --}}
                <div x-show="activeFilter === 'az'" x-transition:enter="transition duration-400 ease-out"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-4 flex items-center gap-1.5 overflow-x-auto no-scrollbar py-1 snap-x" data-no-swipe>
                    <button @click="selectedLetters = []; activeFilter = 'semua'"
                        class="flex-shrink-0 w-8 h-8 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center transition-all active:scale-90 snap-start shadow-sm">
                        <i class="ph-bold ph-x text-[0.7rem]"></i>
                    </button>

                    <template x-for="char in 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('')" :key="char">
                        <button @click="toggleLetter(char)"
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-[0.6rem] font-black transition-all active:scale-95 snap-center shadow-sm border"
                            :class="selectedLetters.includes(char) ? 'bg-[--color-amber] text-white border-transparent' : 'bg-white text-slate-400 border-slate-50'"
                            x-text="char"></button>
                    </template>
                </div>
            </div>
        </header>

        {{-- Cafe Grid (2 Columns Modern Minimalist) --}}
        <main class="relative z-10 px-6 pb-40" x-show="filteredCafes().length > 0">
            <div class="grid grid-cols-2 gap-4">
                <template x-for="(cafe, index) in filteredCafes()" :key="cafe.id">
                    <div class="group flex flex-col bg-white rounded-[28px] border border-slate-50 shadow-soft hover:shadow-premium transition-all duration-500 animate-up overflow-hidden"
                        :style="'animation-delay: ' + (index * 0.05) + 's'" x-data="{ currentImg: 0 }">

                        {{-- Image Gallery Section --}}
                        <div class="relative w-full aspect-square shrink-0 overflow-hidden bg-slate-50 rounded-[32px]">
                            {{-- Swipe Container --}}
                            <div class="flex h-full w-full overflow-x-auto snap-x snap-mandatory no-scrollbar overflow-y-hidden"
                                data-no-swipe
                                @scroll.debounce.100ms="currentImg = Math.round($el.scrollLeft / $el.offsetWidth)">
                                <template x-for="(img, i) in cafe.images" :key="i">
                                    <div class="w-full h-full flex-shrink-0 snap-start relative">
                                        <a :href="cafe.url" class="absolute inset-0 z-10"></a>
                                        <img :src="img"
                                            onerror="this.src='https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=800'"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                            loading="lazy">
                                    </div>
                                </template>
                            </div>

                            {{-- Gallery Navigation Dots --}}
                            <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-1.5 z-20 pointer-events-none"
                                x-show="cafe.images.length > 1">
                                <template x-for="(img, i) in cafe.images" :key="i">
                                    <div class="h-1 rounded-full transition-all duration-300 shadow-sm"
                                        :class="currentImg === i ? 'w-4 bg-white' : 'w-1 bg-white/40'"></div>
                                </template>
                            </div>

                            {{-- Status Badge (Top Right) --}}
                            <div class="absolute top-3.5 right-3.5 z-20">
                                <span
                                    class="px-3 py-1.5 rounded-xl text-[0.62rem] font-bold uppercase text-white tracking-widest backdrop-blur-md shadow-lg"
                                    :class="cafe.isOpen ? 'bg-emerald-500/80' : 'bg-black/40'"
                                    x-text="cafe.isOpen ? 'OPEN' : 'TUTUP'">
                                </span>
                            </div>
                        </div>

                        {{-- Info Area --}}
                        <a :href="cafe.url" class="flex flex-col flex-1 no-underline p-3">
                            <div class="mb-3">
                                <h3 class="font-black text-[--color-espresso] text-[0.85rem] font-display mb-0.5 truncate group-hover:text-[--color-amber] transition-colors leading-tight"
                                    x-text="cafe.name"></h3>
                                <p class="text-slate-400 text-[0.6rem] font-medium line-clamp-1 tracking-tight"
                                    x-text="cafe.address"></p>
                            </div>

                            <div class="mt-auto">
                                {{-- Feature Badges --}}
                                <div class="flex flex-wrap gap-1 mb-4 h-6 items-center overflow-hidden"
                                    x-show="cafe.facilities && cafe.facilities.length > 0">
                                    <template x-for="facility in (cafe.facilities || []).slice(0, 2)" :key="facility">
                                        <span
                                            class="px-2.5 py-1 bg-slate-50 text-slate-400 rounded-lg text-[0.52rem] font-bold whitespace-nowrap"
                                            x-text="facility"></span>
                                    </template>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-5 h-5 rounded-full bg-amber-50 flex items-center justify-center">
                                            <i class="ph-fill ph-bolt text-[--color-amber] text-[0.65rem]"></i>
                                        </div>
                                        <span class="font-black text-[--color-espresso] text-[0.68rem]"
                                            x-text="formatNumber(cafe.energy || 0)"></span>
                                    </div>
                                    <template x-if="userLat && activeFilter === 'terdekat'">
                                        <span
                                            class="font-bold text-indigo-500 text-[0.58rem] tracking-tight bg-indigo-50 px-1.5 py-0.5 rounded-md"
                                            x-text="formatDistance(getDistance(cafe.lat, cafe.lng))"></span>
                                    </template>
                                </div>
                            </div>
                        </a>
                    </div>
                </template>
            </div>
        </main>

        {{-- Empty State --}}
        <div x-show="filteredCafes().length === 0" x-cloak class="relative z-10 px-10 py-32 text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-premium">
                <i class="ph-bold ph-coffee-bean text-3xl text-slate-200"></i>
            </div>
            <h3 class="text-xl font-black text-[--color-espresso] font-display mb-3">Belum Menemukan?</h3>
            <p class="text-[0.8rem] font-bold text-slate-400 leading-relaxed uppercase tracking-widest px-8">
                Coba gunakan kata kunci lain atau periksa koneksi GPS kamu.
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.cafesData = {!! $cafes->map(fn($c) => [
        'id' => data_get($c, 'id'),
        'name' => data_get($c, 'name'),
        'address' => data_get($c, 'address'),
        'energy' => data_get($c, 'total_energy'),
        'isOpen' => data_get($c, 'is_open', false),
        'lat' => data_get($c, 'latitude'),
        'lng' => data_get($c, 'longitude'),
        'facilities' => data_get($c, 'facilities.*.name', []),
        'images' => (function ($cafe) {
            $mainImg = data_get($cafe, 'image_path');
            $gallery = data_get($cafe, 'images', []);
            $all = collect([$mainImg])->merge($gallery)->filter()->unique()->values();

            return $all->map(function ($path) {
                if ($path && str_starts_with($path, 'http'))
                    return $path;
                return ($path && \Illuminate\Support\Facades\Storage::disk('public')->exists($path))
                    ? \Illuminate\Support\Facades\Storage::url($path)
                    : 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=800';
            })->all();
        })($c),
        'url' => route('cafes.show', $c)
    ])->toJson() !!};

        document.addEventListener('alpine:init', () => {
            Alpine.data('exploreLogic', () => ({
                search: '',
                activeFilter: 'semua',
                selectedLetters: [],
                cafes: [],
                userLat: null,
                userLng: null,
                isLocating: false,

                initComponent() {
                    this.cafes = window.cafesData || [];
                },

                toggleLetter(char) {
                    if (this.selectedLetters.includes(char)) {
                        this.selectedLetters = this.selectedLetters.filter(l => l !== char);
                    } else {
                        this.selectedLetters = [...this.selectedLetters, char];
                    }
                },

                getLocation() {
                    if (!navigator.geolocation) {
                        alert('Geolocation tidak didukung oleh browser kamu.');
                        return;
                    }

                    this.isLocating = true;
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            this.userLat = position.coords.latitude;
                            this.userLng = position.coords.longitude;
                            this.isLocating = false;
                        },
                        (error) => {
                            console.error('Error getting location:', error);
                            this.isLocating = false;
                            this.activeFilter = 'semua';
                            alert('Gagal mengambil lokasi. Pastikan GPS aktif ya!');
                        }, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                    );
                },

                getDistance(lat2, lon2) {
                    if (!this.userLat || !this.userLng || !lat2 || !lon2) return null;

                    const R = 6371; // Radius bumi dalam KM
                    const dLat = (lat2 - this.userLat) * Math.PI / 180;
                    const dLon = (lon2 - this.userLng) * Math.PI / 180;
                    const a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(this.userLat * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    return R * c; // Hasil dalam KM
                },

                formatDistance(d) {
                    if (d === null) return '';
                    if (d < 1) return Math.round(d * 1000) + ' m';
                    return d.toFixed(1) + ' km';
                },

                filteredCafes() {
                    let results = [...this.cafes];

                    // 1. Search Filter
                    if (this.search) {
                        const s = this.search.toLowerCase();
                        results = results.filter(c =>
                            c.name.toLowerCase().includes(s) ||
                            c.address.toLowerCase().includes(s)
                        );
                    }

                    // 2. Letter Filter (Multi-select starts width)
                    if (this.selectedLetters.length > 0) {
                        results = results.filter(c =>
                            this.selectedLetters.some(l => c.name.trim().toUpperCase().startsWith(l))
                        );
                    }

                    // 3. Category Filters
                    if (this.activeFilter === 'buka') {
                        results = results.filter(c => c.isOpen);
                    }

                    // 4. Distance Filter & Sort
                    if (this.activeFilter === 'terdekat' && this.userLat) {
                        results.forEach(c => {
                            c.distance = this.getDistance(c.lat, c.lng);
                        });
                        results = results.filter(c => c.distance !== null);
                        results.sort((a, b) => a.distance - b.distance);
                    } else if (this.activeFilter === 'az' || this.selectedLetters.length > 0) {
                        // 5. Default A-Z Sort if requested or letter selected
                        results.sort((a, b) => a.name.localeCompare(b.name));
                    }

                    return results;
                },

                formatNumber(n) {
                    if (n >= 1000) return (n / 1000).toFixed(1) + 'k';
                    return n;
                }
            }));
        });
    </script>
@endpush