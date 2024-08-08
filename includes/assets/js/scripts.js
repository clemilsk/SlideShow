let slideIndex = 0;
let slideInterval;

function startSlideshow() {
    showSlides(slideIndex);
    slideInterval = setInterval(() => {
        changeSlide(1);
    }, 3000); // Muda de slide a cada 3 segundos
}

function changeSlide(n) {
    clearInterval(slideInterval); // Para o autoplay quando o usuário navega manualmente
    showSlides(slideIndex += n);
    startSlideshow(); // Reinicia o autoplay após mudança manual
}

function currentSlide(n) {
    clearInterval(slideInterval); // Para o autoplay quando o usuário navega manualmente
    showSlides(slideIndex = n);
    startSlideshow(); // Reinicia o autoplay após mudança manual
}

function showSlides(n) {
    let slides = document.getElementsByClassName("slide");
    let indicators = document.getElementsByClassName("indicator");
    if (n >= slides.length) {
        slideIndex = 0;
    }
    if (n < 0) {
        slideIndex = slides.length - 1;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.opacity = "0"; // Torna todos os slides invisíveis
        slides[i].classList.remove("active"); // Remove a classe active do texto
        indicators[i].className = indicators[i].className.replace(" active", "");
    }
    slides[slideIndex].style.opacity = "1"; // Torna o slide atual visível
    slides[slideIndex].classList.add("active"); // Adiciona a classe active ao texto
    indicators[slideIndex].className += " active";
}


// Inicia o slideshow ao carregar a página
startSlideshow();
