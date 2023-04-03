window.onscroll = function () { myfun() };

const navbar = document.querySelector('#navbar');

const topPx = navbar.offsetTop;

function myfun() {
    if (window.pageYOffset >= topPx) {
        navbar.classList.add('fixedTop');
    } else {
        navbar.classList.remove('fixedTop');
    }
}