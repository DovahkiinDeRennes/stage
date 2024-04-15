setTimeout(function() {
    var delayedSection = document.getElementById('delayedSection');
    delayedSection.style.display = 'block';
    setTimeout(function() {
        delayedSection.style.opacity = '1';
        delayedSection.style.maxHeight = delayedSection.scrollHeight + 'px';
        // Appliquer l'animation AOS après l'affichage
        delayedSection.setAttribute('data-aos', 'zoom-out');
        delayedSection.setAttribute('data-aos-duration', '2000');
    },); // Délai court avant de démarrer la transition
}, 2000);