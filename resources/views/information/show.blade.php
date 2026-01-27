@extends('layouts.app')

@section('title', $information->title . ' - WadahNgopi.Com')

@section('content')
    <div class="min-h-screen bg-white relative overflow-hidden">
        {{-- Floating Back Button --}}
        <div class="fixed top-6 left-6 z-50 flex gap-4">
            <a href="{{ route('information.index') }}" class="w-10 h-10 flex items-center justify-center bg-white/80 backdrop-blur-md rounded-full border border-slate-100 shadow-glass transition-transform active:scale-90 no-underline text-slate-800">
                <i class="ph-bold ph-arrow-left text-xl"></i>
            </a>
            <button onclick="shareArticle('{{ $information->title }}', '{{ route('information.show', $information->slug) }}')" class="w-10 h-10 flex items-center justify-center bg-white/80 backdrop-blur-md rounded-full border border-slate-100 shadow-glass transition-transform active:scale-90 no-underline text-slate-800">
                <i class="ph-bold ph-share-network text-xl"></i>
            </button>
        </div>

        {{-- Cinematic Hero Section --}}
        @if($information->image_path)
            <div class="relative w-full h-[45vh] overflow-hidden z-0">
                <img src="{{ str_starts_with($information->image_path, 'http') ? $information->image_path : Storage::url($information->image_path) }}" 
                     alt="{{ $information->title }}" 
                     class="w-full h-full object-cover animate-slow-zoom">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/10"></div>
                
                {{-- Category Tag on Image --}}
                <div class="absolute bottom-10 left-6">
                    <span class="px-4 py-1.5 bg-amber-500 text-white rounded-xl text-[0.6rem] font-black uppercase tracking-widest shadow-lg shadow-amber-500/20">
                        {{ $information->category ?? 'Berita' }}
                    </span>
                </div>
            </div>
        @endif

        {{-- Content Container --}}
        <main class="relative z-10 bg-white rounded-t-[40px] -mt-10 pt-10 px-8 pb-32 min-h-[60vh] shadow-[0_-20px_40px_rgba(0,0,0,0.05)]">
            {{-- Publish Date --}}
            <div class="flex items-center gap-2 mb-4 text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest">
                <i class="ph ph-calendar"></i>
                <span>{{ $information->published_at ? $information->published_at->format('d M Y') : $information->created_at->format('d M Y') }}</span>
                <span class="text-slate-200">•</span>
                <span>WadahNgopi Update</span>
            </div>

            <h1 class="text-3xl font-black text-slate-900 font-display leading-tight mb-8 tracking-tighter">
                {{ $information->title }}
            </h1>

            {{-- Editorial Content --}}
            <article class="prose prose-slate max-w-none prose-p:text-slate-600 prose-p:leading-[1.8] prose-p:font-bold prose-p:text-[1.05rem]">
                <div class="content-wrapper">
                    {!! nl2br($information->content) !!}
                </div>
            </article>

            {{-- Post Footer Branding --}}
            <div class="mt-20 pt-10 border-t border-slate-50 flex flex-col items-center">
                <div class="w-10 h-1 bg-slate-100 rounded-full mb-8"></div>
                <div class="flex items-center gap-3 opacity-50 mb-10">
                    <div class="w-8 h-8 rounded-lg overflow-hidden border border-slate-200 grayscale">
                        <img src="{{ asset('images/logo-brand.jpg') }}" alt="WadahNgopi" class="w-full h-full object-cover">
                    </div>
                    <span class="text-[0.6rem] font-black text-slate-400 tracking-[0.3em] uppercase">Membangun Silaturahmi Kalimantan</span>
                </div>
                
                <a href="{{ route('information.index') }}" class="w-full py-4 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center gap-2 text-xs font-black text-slate-600 uppercase tracking-widest active:scale-95 transition-all">
                    BACA BERITA LAINNYA <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </main>
    </div>

    <style>
        .content-wrapper { text-align: justify; }
        .content-wrapper::first-letter {
            font-size: 3.5rem;
            font-weight: 900;
            float: left;
            margin-right: 0.75rem;
            line-height: 1;
            color: #24140D;
            font-family: var(--font-display);
        }
        @keyframes slow-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-slow-zoom {
            animation: slow-zoom 20s ease-in-out infinite alternate;
        }
    </style>
    <script>
        function triggerHaptic() {
            if (window.navigator.vibrate) window.navigator.vibrate(10);
        }

        async function shareArticle(title, url) {
            triggerHaptic();
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: title,
                        text: 'Baca info kopi terbaru: ' + title,
                        url: url
                    });
                } catch (err) {
                    console.log('Share canceled');
                }
            } else {
                await navigator.clipboard.writeText(url);
                alert('Link berita berhasil disalin!');
            }
        }
    </script>
@endsection
