/* Top bar */
document.addEventListener('DOMContentLoaded', function (event) {
    document.querySelectorAll('.top-bar__menu-trigger, .off-canvas-menu__trigger').forEach(function (el) {
        el.onclick = function () {
            const offCanvasMenu = document.querySelector('.off-canvas-menu');
            offCanvasMenu.classList.toggle('off-canvas-menu--expanded');
            if (offCanvasMenu.getAttribute('aria-hidden')=='true') {
                offCanvasMenu.setAttribute('aria-hidden', 'false')
            } else {
                offCanvasMenu.setAttribute('aria-hidden', 'true')
            }
        };
    });
});