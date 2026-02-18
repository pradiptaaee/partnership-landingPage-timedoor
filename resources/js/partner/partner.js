
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar-custom');
    if (window.scrollY > 50) {
        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.12)';
    } else {
        navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.00)';
    }
});

// menu nav ketika mobile
const btn = document.getElementById('menuBtn');
const menu = document.getElementById('mobileMenu');

btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
});

document.getElementById("loadMoreLink").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("moreWorkshops").classList.remove("d-none");
    this.style.display = "none";
});

// load more 2
document.getElementById("loadMore").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("Workshops").classList.remove("d-none");
    this.style.display = "none";
});