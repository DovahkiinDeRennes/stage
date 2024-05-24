document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const carouselItems = Array.from(document.querySelectorAll('.carousel-item'));
    const itemsPerPageDesktop = 4; // Nombre d'éléments par page sur ordinateur
    const itemsPerPageMobile = 1;  // Nombre d'éléments par page sur mobile
    let currentIndex = 0;
    let autoScrollInterval;
    let touchStartX = 0;

    // Fonction pour afficher les éléments nécessaires
    function showItems() {
        // Supprimer les éléments existants
        carousel.innerHTML = '';
        
        // Récupérer les éléments à afficher
        const itemsToShow = [];
        const itemsPerPage = window.innerWidth >= 768 ? itemsPerPageDesktop : itemsPerPageMobile; // Utiliser 768 pixels comme seuil pour les appareils mobiles
        for (let i = 0; i < itemsPerPage; i++) {
            const index = (currentIndex + i) % carouselItems.length;
            const clonedItem = carouselItems[index].cloneNode(true);
            clonedItem.style.opacity = 0; // Définir l'opacité initiale à 0
            itemsToShow.push(clonedItem);
        }
        
        // Ajouter les éléments à afficher dans le carrousel sans transition d'opacité initiale
        itemsToShow.forEach((item, index) => {
            carousel.appendChild(item);
        });
    
        // Mettre à jour les boutons de pagination
        updatePagination();
    
        // Appliquer la transition d'opacité pour faire apparaître les éléments
        setTimeout(() => {
            itemsToShow.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = 1; // Rendre progressivement l'élément visible en lui attribuant une opacité de 1
                }, 50 * index); // Délai de 50ms entre chaque élément pour créer un effet de transition
            });
        }, 0);
    }
    
    

    // Fonction pour mettre à jour les boutons de pagination
    function updatePagination() {
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = '';
        for (let i = 0; i < carouselItems.length; i++) {
            const button = document.createElement('button');
            button.textContent = i + 1;
            button.addEventListener('click', function() {
                clearInterval(autoScrollInterval); // Arrêter le défilement automatique lorsqu'on clique sur un bouton de pagination
                currentIndex = i;
                showItems();
            });
            if (i === currentIndex) {
                button.classList.add('active');
            }
            paginationContainer.appendChild(button);
        }
    }

    // Fonction pour faire défiler le carrousel automatiquement
    function autoScroll() {
        currentIndex = (currentIndex + 1) % carouselItems.length;
        showItems();
    }

    // Initialisation pour afficher les premisers éléments
    showItems();

    // Démarrer le défilement automatique toutes les cinq secondes
    autoScrollInterval = setInterval(autoScroll, 6000);

    // Écouteurs d'événements pour les boutons de navigation manuelle
    document.querySelector('.prev').addEventListener('click', function() {
        clearInterval(autoScrollInterval); // Arrêter le défilement automatique lorsqu'on clique sur le bouton de navigation manuelle
        currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
        showItems();
    });

    document.querySelector('.next').addEventListener('click', function() {
        clearInterval(autoScrollInterval); // Arrêter le défilement automatique lorsqu'on clique sur le bouton de navigation manuelle
        currentIndex = (currentIndex + 1) % carouselItems.length;
        showItems();
    });

    // Écouteur d'événement pour le début du glissement tactile
    carousel.addEventListener('touchstart', function(event) {
        touchStartX = event.touches[0].clientX;
    });

    // Écouteur d'événement pour la fin du glissement tactile
    carousel.addEventListener('touchend', function(event) {
        const touchEndX = event.changedTouches[0].clientX;
        const deltaX = touchEndX - touchStartX;

        if (deltaX > 0) {
            // Glissement vers la droite
            clearInterval(autoScrollInterval);
            currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
            showItems();
        } else if (deltaX < 0) {
            // Glissement vers la gauche
            clearInterval(autoScrollInterval);
            currentIndex = (currentIndex + 1) % carouselItems.length;
            showItems();
        }
    });

    // Redimensionner le carrousel lorsque la taille de l'écran change
    window.addEventListener('resize', showItems);
});
