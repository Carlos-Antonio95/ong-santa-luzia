function toggleMenu() {
    const menu = document.getElementById('menu');
    const button = document.querySelector('.menu-toggle');

    menu.classList.toggle('active');

    if (button) {
        button.classList.toggle('active');
    }
}
