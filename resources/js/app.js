import './bootstrap';
import './landing_page/app.js';

// import { runLandingPageModules } from 'resources/js/admin/landing_page/app.js';
import { runLandingPageModules } from './admin/landing_page/app.js';


document.addEventListener('DOMContentLoaded', () => {
    // Jalankan semua logic Landing Page
    runLandingPageModules();
});

// document.addEventListener('DOMContentLoaded', () => {
//     // Jalankan semua logic Landing Page
//     runLandingPageModules();
// });
