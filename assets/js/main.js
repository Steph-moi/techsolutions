// Validation formulaire de contact
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const consent = document.getElementById('consent');
            
            if (!consent.checked) {
                e.preventDefault();
                alert('Vous devez accepter la politique de confidentialité pour continuer.');
                return false;
            }
        });
    }
    
    // Confirmation suppression
    const deleteLinks = document.querySelectorAll('a[href*="delete"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                e.preventDefault();
            }
        });
    });
});
