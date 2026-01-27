const CACHE_NAME = 'wadahngopi-v4';
const STATIC_ASSETS = [
    '/',
    '/manifest.json',
    '/offline',
    '/favicon.ico',
];

self.addEventListener('install', event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => cache.addAll(STATIC_ASSETS))
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(
        Promise.all([
            self.clients.claim(),
            caches.keys().then(keys => Promise.all(
                keys.map(key => {
                    if (key !== CACHE_NAME) return caches.delete(key);
                })
            ))
        ])
    );
});

self.addEventListener('fetch', event => {
    // Skip non-GET requests
    if (event.request.method !== 'GET') return;

    const url = new URL(event.request.url);

    // Dynamic Pages & API: Network First
    if (url.pathname.startsWith('/explore') || url.pathname.startsWith('/cafes') || url.pathname === '/' || url.pathname.startsWith('/information')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    if (!response || response.status !== 200) return response;

                    const resClone = response.clone();
                    caches.open(CACHE_NAME).then(cache => cache.put(event.request, resClone));
                    return response;
                })
                .catch(async () => {
                    const cache = await caches.open(CACHE_NAME);
                    const cachedResponse = await cache.match(event.request);
                    if (cachedResponse) return cachedResponse;

                    // If it's a page request, show offline fallback
                    if (event.request.mode === 'navigate') {
                        return cache.match('/offline');
                    }
                })
        );
        return;
    }

    // Images & Static: Stale While Revalidate
    event.respondWith(
        caches.match(event.request)
            .then(cachedResponse => {
                const fetchPromise = fetch(event.request).then(networkResponse => {
                    if (!networkResponse || networkResponse.status !== 200) {
                        return networkResponse;
                    }

                    const responseToCache = networkResponse.clone();
                    caches.open(CACHE_NAME).then(cache => {
                        cache.put(event.request, responseToCache);
                    });

                    return networkResponse;
                }).catch(() => {
                    // Fail silently
                });

                return cachedResponse || fetchPromise;
            })
    );
});
