// Validation formulaire de contact - Commentaire expliquant la fonction de validation
document.addEventListener('DOMContentLoaded', function() { // Écoute l'événement de chargement complet du DOM
    const contactForm = document.getElementById('contactForm'); // Récupère l'élément formulaire de contact par son ID
    
    if (contactForm) { // Vérifie si le formulaire de contact existe sur la page
        contactForm.addEventListener('submit', function(e) { // Ajoute un écouteur d'événement sur la soumission du formulaire
            const consent = document.getElementById('consent'); // Récupère la case à cocher de consentement RGPD
            
            if (!consent.checked) { // Vérifie si la case de consentement n'est pas cochée
                e.preventDefault(); // Empêche la soumission du formulaire
                alert('Vous devez accepter la politique de confidentialité pour continuer.'); // Affiche un message d'alerte
                return false; // Retourne false pour arrêter l'exécution
            }
        });
    }
    
    // Confirmation suppression - Commentaire expliquant la confirmation de suppression
    const deleteLinks = document.querySelectorAll('a[href*="delete"]'); // Sélectionne tous les liens contenant "delete" dans leur href
    deleteLinks.forEach(link => { // Parcourt chaque lien de suppression
        link.addEventListener('click', function(e) { // Ajoute un écouteur de clic sur chaque lien
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) { // Affiche une boîte de confirmation
                e.preventDefault(); // Si l'utilisateur annule, empêche le clic
            }
        });
    });
}); // Fin de l'écouteur DOMContentLoaded
