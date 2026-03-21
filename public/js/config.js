function toogleMenu(){
    const menu = document.getElementById("menu");
    menu.classList.toggle("active");
}

function toggleMenu(){
    const menu = document.getElementById("menu");
    const button = document.querySelector(".menu-toggle");
    
    menu.classList.toggle("active");
    button.classList.toggle("active");
}