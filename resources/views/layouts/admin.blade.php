<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Glow & Chic')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/views/layouts/admin.css') }}">
    
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Desktop Sidebar -->
            <div class="col-md-2 d-none d-md-block p-0">
                <div class="dashboard-nav sticky-top" style="top: 0; height: 100vh;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/icons/logo.png') }}" alt="Logo" style="height: 40px;">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Tableau de board</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                                href="{{ route('categories.index') }}">
                                <i class="fas fa-th-large"></i>
                                <span>Categories
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Utilisateur</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('DashAppointment.*') ? 'active' : '' }}"
                                href="{{ route('DashAppointment.index') }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>Rendez vous</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('offers.*') ? 'active' : '' }}"
                                href="{{ route('offers.index') }}">
                                <i class="fas fa-spa"></i>
                                <span>Prestations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}"
                                href="{{ route('stock.index') }}">
                                <i class="fas fa-warehouse"></i>
                                <span>Stock</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}"
                                href="{{ route('messages.index') }}">
                                <i class="fas fa-envelope"></i>
                                <span>Message</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}"
                                href="{{ route('gallery.index') }}">
                                <i class="fas fa-photo-video"></i>
                                <span>Gallery</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                                <span>Aller au site</span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link logout-btn" href="#"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto p-0">
                <div class="main-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-nav fixed-bottom d-md-none">
        <ul class="nav justify-content-around">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('userDashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Accueil</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Utilisateur</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('DashAppointment.*') ? 'active' : '' }}"
                    href="{{ route('DashAppointment.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rendez vous</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('offers.*') ? 'active' : '' }}"
                    href="{{ route('offers.index') }}">
                    <i class="fas fa-spa"></i>
                    <span>Pretations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}"
                    href="{{ route('stock.index') }}">
                    <i class="fas fa-boxes"></i>
                    <span>Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('maessages.*') ? 'active' : '' }}"
                    href="{{ route('messages.index') }}">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}"
                    href="{{ route('gallery.index') }}">
                    <i class="fas fa-photo-video"></i>
                    <span>Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link logout-btn" href="#"
                        onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Deconnexion</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     {{-- <script> if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js', {
            type: 'module'
        })
        .then(reg => console.log('Service Worker registered:', reg))
        .catch(err => console.error('Service Worker registration failed:', err));
    }
    </script> --}}
    {{-- <script type="module" src={{asset("service-worker.js")}}></script> --}}

    <script type="module">
        import "https://www.gstatic.com/firebasejs/11.10.0/firebase-app-compat.js";
        import 'https://www.gstatic.com/firebasejs/10.3.0/firebase-messaging-compat.js';
        const firebaseConfig = {
            apiKey: "AIzaSyBw_0MnK82NiYCwIphSzFShoMVFDNwfgEI",
            authDomain: "glow-and-chic.firebaseapp.com",
            projectId: "glow-and-chic",
            storageBucket: "glow-and-chic.firebasestorage.app",
            messagingSenderId: "1364631713",
            appId: "1:1364631713:web:f8bd3db73cec67b76b50e0",
            measurementId: "G-3B6N2DS03Y"
        };

        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();
        async function requestPermissionAndGetToken() {
            try {
            // Check if browser supports notifications
            if (!("Notification" in window)) {
                console.warn("This browser does not support desktop notification.");
                return;
            }

            // Check current permission status
            if (Notification.permission === "granted") {
                console.log("Notification permission already granted.");
            } else if (Notification.permission === "denied") {
                console.warn("Notification permission explicitly denied by the user.");
                return;
            } else { // 'default' or not yet asked
                const permission = await Notification.requestPermission();
                if (permission !== 'granted') {
                console.warn('Notification permission not granted by the user.');
                return;
                }
            }

            const token = await messaging.getToken({ vapidKey: 'BFa-RUn46d5nfESUlVj__OfNoYCZyeGVo9lLDhTOtRjpVYv8qt9s72oXmX96-qDG8j0gQ1qPj_WRHIy4jblmTpA' });
            console.log('FCM Token:', token);
            // Send this token to your Laravel backend via AJAX
            sendTokenToServer(token);

            } catch (error) {
            console.error('Error getting FCM token:', error);
            // Handle cases where token retrieval might fail, e.g., missing service worker
            }
        }

        // Function to send token to your Laravel backend
        function sendTokenToServer(token) {
            fetch('/save-fcm-token', { // Create this API endpoint in Laravel
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // If using CSRF token
            },
            body: JSON.stringify({ fcm_token: token })
            })
            .then(response => response.json())
            .then(data => {
            console.log('Token saved:', data);
            })
            .catch(error => {
            console.error('Error saving token:', error);
            });
        }

        // Register the service worker and then request token
            navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then((registration) => {
            console.log('Service Worker registered with scope:', registration.scope);
            requestPermissionAndGetToken(); // Call this AFTER service worker registration
            })
            .catch((error) => {
            console.error('Service Worker registration failed:', error);
            });


        // Handle incoming messages while in the foreground (optional, but good for UX)
        messaging.onMessage((payload) => {
            console.log('Foreground message received. ', payload);
            // Customize notification display for foreground messages if you want
            // Browsers often don't show native notifications for foreground messages,
            // so you might display an in-app toast or banner instead.
            const notificationTitle = payload.notification.title;
            const notificationOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon || '/assets/images/icons/preview.jpg' // Use icon from payload or default
            };
            // Display as a regular Notification API notification in foreground
            new Notification(notificationTitle, notificationOptions);
        });
    </script>
</body>

</html>
