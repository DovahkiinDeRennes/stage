document.addEventListener("DOMContentLoaded", function() {
    var buttons = document.querySelectorAll('.boutonAfficherPlus');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            var index = this.getAttribute('data-index');
            toggleReadMore(index);
        });
    });

    function toggleReadMore(index) {
        var texteCourt = document.getElementById('texteCourt-' + index);
        var texteLong = document.getElementById('texteLong-' + index);
        var button = document.querySelector('.boutonAfficherPlus' + index);

        if (texteCourt.style.display === '' || texteCourt.style.display === 'block') {
            // Si le texte court est affiché ou n'a pas de style, basculer vers le texte long
            texteCourt.style.display = 'none';
            texteLong.style.display = 'block';
            button.textContent = 'Lire moins';
        } else {
            // Sinon, basculer vers le texte court
            texteCourt.style.display = 'block';
            texteLong.style.display = 'none';
            button.textContent = 'Lire plus';
        }
    }
});
