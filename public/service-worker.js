self.addEventListener('install', function (event) {
    event.waitUntil(
      caches.open('my-app-cache').then(function (cache) {
        return cache.addAll([
          '/',
          '/css/app.css',
          '/js/app.js',
          '/images/logo.png'
        ]);
      })
    );
  });
  
  self.addEventListener('fetch', function (event) {
    event.respondWith(
      caches.match(event.request).then(function (response) {
        return response || fetch(event.request);
      })
    );
  });
  