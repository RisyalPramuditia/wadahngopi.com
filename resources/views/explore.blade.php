@extends('layouts.app')

@section('title', 'Explore - WadahNgopi.Com')

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
                        <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi Logo" class="w-full h-full object-cover">
                    </div>
                    <h1 class="text-xl font-black text-[--color-espresso] font-display">
                        Wadah<span class="text-[--color-amber]">Ngopi</span>
                    </h1>
                </div>

                {{-- A-Z Alphabetical Filter --}}
                <div class="flex items-center gap-2">
                    <button @click="sortAz = !sortAz" 
                        class="flex items-center justify-center gap-1.5 px-3 py-1.5 bg-white shadow-soft border border-slate-50 rounded-xl transition-all duration-300"
                        :class="sortAz ? 'border-[--color-amber] text-[--color-amber]' : 'text-slate-300'">
                        <span class="text-[0.55rem] font-black tracking-tighter uppercase">Aa</span>
                        <span class="text-[0.58rem] font-bold uppercase tracking-widest">A-Z</span>
                    </button>
                </div>
            </div>

            <div class="search-luxury-box mb-6">
                <i class="ph-bold ph-magnifying-glass text-[--color-amber] text-lg"></i>
                <input type="text" x-model="search" placeholder="Cari café idamanmu..." @keyup.escape="search = ''" class="font-display">
            </div>

            <div class="flex items-center gap-2 overflow-visible">
                <div class="pills-container-luxury flex-1 overflow-x-auto no-scrollbar py-2">
                    <button class="pill-luxury" :class="activeFilter === 'semua' ? 'active' : ''"
                        @click="activeFilter = 'semua'">Semua</button>
                    <button class="pill-luxury" :class="activeFilter === 'terdekat' ? 'active' : ''"
                        @click="activeFilter = 'terdekat'; getLocation()">
                        <i class="ph-bold ph-map-pin" x-show="!isLocating"></i>
                        <i class="ph-bold ph-circle-notch animate-spin" x-show="isLocating"></i>
                        <span>Terdekat</span>
                    </button>
                    <button class="pill-luxury" :class="activeFilter === 'buka' ? 'active' : ''"
                        @click="activeFilter = 'buka'">Buka</button>
                </div>
            </div>
        </header>

        {{-- Cafe Grid (2 Columns Modern Minimalist) --}}
        <main class="relative z-10 px-6 pb-40" x-show="filteredCafes().length > 0">
            <div class="grid grid-cols-2 gap-4">
                <template x-for="(cafe, index) in filteredCafes()" :key="cafe.id">
                    <a :href="cafe.url" class="group flex flex-col bg-white rounded-[28px] border border-slate-50 shadow-soft hover:shadow-premium transition-all duration-500 animate-up no-underline overflow-hidden" :style="'animation-delay: ' + (index * 0.05) + 's'">
                        {{-- Image with Aspect Video --}}
                        <div class="relative aspect-video shrink-0 overflow-hidden">
                            <img :src="cafe.image || 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=800'"
                                onerror="this.src='https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=800'"
                                :alt="cafe.name" class="w-full h-full object-cover aspect-square transition-transform duration-500 group-hover:scale-110" loading="lazy">
                            
                            {{-- Status Badge (Top Left) --}}
                            <div class="absolute top-2 left-2 z-10">
                                <span class="px-2.5 py-1 rounded-lg text-[0.55rem] font-black uppercase text-white tracking-widest backdrop-blur-md"
                                    :class="cafe.isOpen ? 'bg-emerald-500/60' : 'bg-black/60 shadow-xl'"
                                    x-text="cafe.isOpen ? 'OPEN' : 'TUTUP'">
                                </span>
                            </div>
                        </div>

                        {{-- Info Area --}}
                        <div class="p-3.5 flex flex-col flex-1">
                            <h3 class="font-black text-[--color-espresso] text-[0.85rem] font-display mb-1 truncate group-hover:text-[--color-amber] transition-colors leading-tight" x-text="cafe.name"></h3>
                            <p class="text-slate-400 text-[0.6rem] font-bold line-clamp-1 mb-2 uppercase tracking-tighter" x-text="cafe.address"></p>

                            {{-- Feature Badges --}}
                            <div class="flex flex-wrap gap-1 mb-3" x-show="cafe.facilities && cafe.facilities.length > 0">
                                <template x-for="facility in (cafe.facilities || []).slice(0, 2)" :key="facility">
                                    <span class="px-1.5 py-0.5 bg-slate-50 text-slate-500 rounded text-[0.5rem] font-bold uppercase tracking-tight" x-text="facility"></span>
                                </template>
                            </div>

                            <div class="mt-auto flex items-center justify-between">
                                <div class="flex items-center gap-1">
                                    <i class="ph-fill ph-bolt text-[--color-amber] text-[0.6rem]"></i>
                                    <span class="font-black text-[--color-espresso] text-[0.65rem]" x-text="formatNumber(cafe.energy || 0)"></span>
                                </div>
                                <template x-if="userLat && activeFilter === 'terdekat'">
                                    <span class="font-black text-indigo-500 text-[0.55rem] tracking-tighter" x-text="formatDistance(getDistance(cafe.lat, cafe.lng))"></span>
                                </template>
                            </div>
                        </div>
                    </a>
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
        'id' => $c->id,
        'name' => $c->name,
        'address' => $c->address,
        'energy' => $c->total_energy,
        'isOpen' => $c->is_open,
        'lat' => $c->latitude,
        'lng' => $c->longitude,
        'facilities' => $c->facilities->pluck('name'),
        'image' => (function($path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http')) return $path;
            return \Illuminate\Support\Facades\Storage::disk('public')->exists($path) 
                ? \Illuminate\Support\Facades\Storage::url($path) 
                : null;
        })($c->image_path),
        'url' => route('cafes.show', $c)
    ])->toJson() !!};

        document.addEventListener('alpine:init', () => {
            Alpine.data('exploreLogic', () => ({
                search: '',
                activeFilter: 'semua',
                sortAz: false,
                cafes: [],
                userLat: null,
                userLng: null,
                isLocating: false,

                initComponent() {
                    this.cafes = window.cafesData || [];
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

                    if (this.search) {
                        const s = this.search.toLowerCase();
                        results = results.filter(c =>
                            c.name.toLowerCase().includes(s) ||
                            c.address.toLowerCase().includes(s)
                        );
                    }

                    if (this.activeFilter === 'buka') {
                        results = results.filter(c => c.isOpen);
                    }

                    if (this.activeFilter === 'terdekat' && this.userLat) {
                        results.forEach(c => {
                            c.distance = this.getDistance(c.lat, c.lng);
                        });
                        results = results.filter(c => c.distance !== null);
                        results.sort((a, b) => a.distance - b.distance);
                    }

                    if (this.sortAz) {
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