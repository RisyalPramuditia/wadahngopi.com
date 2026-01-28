<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta name="theme-color" content="#FFFDFB" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#24140D" media="(prefers-color-scheme: dark)">

    {{-- iOS Specific --}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="WadahNgopi">
    <link rel="apple-touch-icon" href="/icons/icon-192x192.png">

    <link rel="manifest" href="/manifest.json">

    <title>@yield('title', 'WadahNgopi')</title>

    <!-- Fonts - Modern & Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons & Interactivity -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/css/luxury.css', 'resources/js/app.js'])
</head>

<body x-data="globalGestures()" @touchstart="handleTouchStart($event)" @touchend="handleTouchEnd($event)">
    <div class="main-container">
        @yield('content')

        <nav class="bottom-nav">
            <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="{{ request()->routeIs('home') ? 'ph-fill ph-house' : 'ph ph-house' }}"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('explore') }}" class="nav-item {{ request()->routeIs('explore') ? 'active' : '' }}">
                <i class="{{ request()->routeIs('explore') ? 'ph-fill ph-compass' : 'ph ph-compass' }}"></i>
                <span>Jelajah</span>
            </a>
            <a href="{{ route('saved') }}" class="nav-item {{ request()->routeIs('saved') ? 'active' : '' }}">
                <i
                    class="{{ request()->routeIs('saved') ? 'ph-fill ph-bookmark-simple' : 'ph ph-bookmark-simple' }}"></i>
                <span>Simpan</span>
            </a>
            <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="{{ request()->routeIs('profile') ? 'ph-fill ph-article' : 'ph ph-article' }}"></i>
                <span>Info</span>
            </a>
        </nav>
    </div>

    <script>
        // Global PWA Gestures & Logic (Simple Version)
        document.addEventListener('alpine:init', () => {
            Alpine.data('globalGestures', () => ({
                touchStartX: 0,
                touchStartY: 0,
                minSwipeDist: 100,

                handleTouchStart(e) {
                    this.touchStartX = e.changedTouches[0].screenX;
                    this.touchStartY = e.changedTouches[0].screenY;
                },

                handleTouchEnd(e) {
                    const endX = e.changedTouches[0].screenX;
                    const endY = e.changedTouches[0].screenY;
                    const diffX = endX - this.touchStartX;
                    const diffY = endY - this.touchStartY;

                    const absX = Math.abs(diffX);
                    const absY = Math.abs(diffY);

                    // Ignore if vertical scroll is dominant or distance is too small
                    if (absY > absX || absX < this.minSwipeDist) return;

                    // Ensure we are not swiping on a scrollable element
                    const target = e.target.closest('[data-no-swipe], .overflow-x-auto, .no-scrollbar, .ph-slideshow');
                    if (target) return;

                    if (diffX > 0) {
                        this.navigatePrevious();
                    } else {
                        this.navigateNext();
                    }
                },

                navigatePrevious() {
                    const currentPath = window.location.pathname;
                    if (currentPath === '/') return; 
                    
                    if (currentPath.includes('/cafes/')) {
                        window.history.back();
                    } else {
                        const order = ['/', '/explore', '/saved', '/profile'];
                        const idx = order.indexOf(currentPath);
                        if (idx > 0) window.location.href = order[idx - 1];
                    }
                },

                navigateNext() {
                    const currentPath = window.location.pathname;
                    const order = ['/', '/explore', '/saved', '/profile'];
                    const idx = order.indexOf(currentPath);
                    if (idx !== -1 && idx < order.length - 1) {
                        window.location.href = order[idx + 1];
                    }
                }
            }));
        });

        // Register Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
    @stack('scripts')
</body>

</html>