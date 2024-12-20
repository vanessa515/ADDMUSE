self.addEventListener('install', function(event) {
 
    event.waitUntil(
        caches.open('my-cache').then(function(cache) {
            return cache.addAll([
              "ADDMUSE/index.blade.php",
            
             
            ]);
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        })
    );
});
