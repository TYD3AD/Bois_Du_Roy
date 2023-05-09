function showPopup() {
  // Récupérer l'ID de la demande de congé à partir de l'attribut data-id
  const demandeId = event.target.dataset.id;

  // Créer le contenu HTML du pop-up
  const popupContent = `
      <h3>Refuser la demande de congé</h3>
      <form action="traiter_refus_demande.php" method="POST">
        <input type="hidden" name="demandeId" value="${demandeId}">
        <label for="motifRefus">Motif du refus :</label>
        <input type="text" name="motifRefus" required>
        <button type="submit">Envoyer</button>
      </form>
    `;

  // Créer un élément div pour le pop-up
  const popup = document.createElement('div');
  popup.classList.add('popup');
  popup.innerHTML = popupContent;

  // Ajouter le pop-up à la page
  document.body.appendChild(popup);
}
