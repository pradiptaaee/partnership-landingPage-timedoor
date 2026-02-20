// ============================================
// SIDEBAR TOGGLE FUNCTIONS
// ============================================

/**
 * Toggle Landing Page Menu Dropdown
 */
function toggleLandingMenu() {
    const menu = document.getElementById('landing-menu');
    const chevron = document.getElementById('landing-chevron');

    if (!menu || !chevron) {
        console.error('❌ Landing menu elements not found');
        return;
    }

    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        chevron.classList.add('rotate-180');
    } else {
        menu.classList.add('hidden');
        chevron.classList.remove('rotate-180');
    }
}

// Export to window untuk bisa dipanggil dari HTML
window.toggleLandingMenu = toggleLandingMenu;

console.log('✅ Sidebar module loaded');