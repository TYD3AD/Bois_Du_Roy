function OpenPopup(id) {
    // Masquer tous les autres popups
    var popups = document.querySelectorAll('.popup');
    for (var i = 0; i < popups.length; i++) {
        popups[i].style.display = 'none';
    }

    // Afficher le popup correspondant
    var popup = document.getElementById('popupRefuser_' + id);
    popup.style.display = 'block';
}


function closePopUpRefus(id) {
    const popup = document.getElementById('popupRefus_' + id);
    if (popup !== null) {
        popup.style.display = 'none';
    }
    else {
        console.log("element null");
    }
}


function SendPopup() {
    var motif = document.getElementById("motif").value;

    if (motif == "") {
        alert("Veuillez remplir le motif");
    }
    else {
        alert("Votre demande a bien été envoyé");
        document.getElementById("popup").style.display = "none";
    }

}

function compteShow() {
    var x = document.getElementById("compte");
    if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
    } else {
        x.style.visibility = "hidden";
    }
}
