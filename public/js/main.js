/* HEADER : changer les style des liens actifs dans le menu */
let navLink = document.querySelectorAll('.nav-link');

if (navLink) {
    // ajouter la classe active sur le lien de la page actuelle 
    let url = location.pathname.split("/")[1];

    navLink.forEach(link => {
        // si le nom du lien contient le nom de la page (url)
        if (link.innerHTML.includes(url[0].toUpperCase())) {
            link.classList.add('active');
        }
    }) 
}
