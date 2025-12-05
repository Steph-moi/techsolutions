<?php require_once 'config/database.php'; ?> <!-- Inclusion de la configuration de base de données -->
<?php include 'includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="contact"> <!-- Section de contact avec classe CSS -->
    <h1>Contactez-nous</h1> <!-- Titre principal de la page de contact -->
    
    <?php if(isset($_SESSION['contact_success'])): ?> <!-- Vérifie si un message de succès existe en session -->
        <div class="alert success">Votre message a été envoyé avec succès !</div> <!-- Affiche le message de succès -->
        <?php unset($_SESSION['contact_success']); ?> <!-- Supprime le message de la session -->
    <?php endif; ?> <!-- Fin de la condition -->
    
    <form id="contactForm" action="/techsolutions/api/contact.php" method="POST"> <!-- Formulaire de contact avec méthode POST -->
        <div class="form-group"> <!-- Groupe de champ de formulaire -->
            <label for="nom">Nom *</label> <!-- Étiquette pour le champ nom -->
            <input type="text" id="nom" name="nom" required> <!-- Champ de saisie texte obligatoire pour le nom -->
        </div> <!-- Fin du groupe nom -->
        
        <div class="form-group"> <!-- Groupe de champ email -->
            <label for="email">Email *</label> <!-- Étiquette pour le champ email -->
            <input type="email" id="email" name="email" required> <!-- Champ de saisie email obligatoire -->
        </div> <!-- Fin du groupe email -->
        
        <div class="form-group"> <!-- Groupe de champ sujet -->
            <label for="sujet">Sujet *</label> <!-- Étiquette pour le champ sujet -->
            <input type="text" id="sujet" name="sujet" required> <!-- Champ de saisie texte obligatoire pour le sujet -->
        </div> <!-- Fin du groupe sujet -->
        
        <div class="form-group"> <!-- Groupe de champ message -->
            <label for="message">Message *</label> <!-- Étiquette pour le champ message -->
            <textarea id="message" name="message" rows="5" required></textarea> <!-- Zone de texte obligatoire de 5 lignes -->
        </div> <!-- Fin du groupe message -->
        
        <div class="form-group checkbox"> <!-- Groupe de case à cocher -->
            <input type="checkbox" id="consent" name="consent_rgpd" required> <!-- Case à cocher obligatoire pour le consentement RGPD -->
            <label for="consent"> <!-- Étiquette pour la case à cocher -->
                J'accepte que mes données personnelles soient collectées et traitées conformément 
                à la <a href="/techsolutions/rgpd.php" target="_blank">politique de confidentialité</a> * <!-- Texte de consentement avec lien vers RGPD -->
            </label> <!-- Fin de l'étiquette -->
        </div> <!-- Fin du groupe checkbox -->
        
        <button type="submit">Envoyer</button> <!-- Bouton de soumission du formulaire -->
    </form> <!-- Fin du formulaire -->
</section> <!-- Fin de la section contact -->

<?php include 'includes/footer.php'; ?>
