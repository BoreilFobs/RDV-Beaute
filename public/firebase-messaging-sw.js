importScripts("https://www.gstatic.com/firebasejs/11.10.0/firebase-app-compat.js");
importScripts('https://www.gstatic.com/firebasejs/10.3.0/firebase-messaging-compat.js');

  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyBw_0MnK82NiYCwIphSzFShoMVFDNwfgEI",
    authDomain: "glow-and-chic.firebaseapp.com",
    projectId: "glow-and-chic",
    storageBucket: "glow-and-chic.firebasestorage.app",
    messagingSenderId: "1364631713",
    appId: "1:1364631713:web:f8bd3db73cec67b76b50e0",
    measurementId: "G-3B6N2DS03Y"
  };

  // Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// Handle incoming messages when the app is in the background/closed
messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);

  // If you are sending a 'notification' payload from your backend,
  // this is where you extract it.
  const notificationTitle = payload.notification ? payload.notification.title : 'New Notification';
  const notificationBody = payload.notification ? payload.notification.body : 'You have a new update.';
  const notificationIcon = (payload.notification && payload.notification.icon) || '/assets/images/icons/preview.jpg';

  const notificationOptions = {
    body: notificationBody,
    icon: notificationIcon,
    // data: payload.data // Pass the entire data payload for easier access on click
    data: payload.data || {} // Ensure data property exists, even if empty
  };

  // Show the notification
  self.registration.showNotification(notificationTitle, notificationOptions);
});
// Optional: Handle notification clicks (when user clicks on the notification)
self.addEventListener('notificationclick', (event) => {
  console.log('Notification clicked', event);
  event.notification.close(); // Close the notification

  const clickedNotification = event.notification;
  const customData = clickedNotification.data; // Access data you passed in `notificationOptions.data`

  // Example: Open a specific URL when notification is clicked
  const urlToOpen = customData?.click_action || payload.data.url; // Or from payload.data.url
  event.waitUntil(
    clients.openWindow(urlToOpen)
  );
});