document.getElementById('search').addEventListener('input', function() {
    var filter = this.value.toLowerCase();
    var cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
        var header = card.querySelector('.card-header').textContent.toLowerCase();
        var links = card.querySelectorAll('.card a');
        var match = header.includes(filter);

        links.forEach(function(link) {
            if (link.textContent.toLowerCase().includes(filter) || match) {
                link.style.display = '';
                match = true;
            } else {
                link.style.display = 'none';
            }
        });

        card.style.display = match ? 'block' : 'none';
    });
});

function toggleDropdown() {
    document.getElementById("dropdown-content").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

