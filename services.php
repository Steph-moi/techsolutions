<?php
require_once 'config/database.php';
include 'includes/header.php';
?>

<section class="services-page">
    <h1>Nos Services</h1>
    <p>TechSolutions vous accompagne dans tous vos projets informatiques</p>
    
    <div class="service-grid">
        <div class="service-card">
            <h3>💻 Développement Logiciels</h3>
            <p>Création d'applications sur mesure, sites web, logiciels métier adaptés à vos besoins spécifiques.</p>
            <ul>
                <li>Applications web et mobiles</li>
                <li>Logiciels de gestion</li>
                <li>Sites e-commerce</li>
                <li>APIs et intégrations</li>
            </ul>
        </div>
        
        <div class="service-card">
            <h3>🛠️ Support Client</h3>
            <p>Assistance technique complète pour maintenir vos systèmes en parfait état de fonctionnement.</p>
            <ul>
                <li>Support technique 24/7</li>
                <li>Maintenance préventive</li>
                <li>Formation utilisateurs</li>
                <li>Résolution d'incidents</li>
            </ul>
        </div>
        
        <div class="service-card">
            <h3>🏗️ Gestion des Infrastructures</h3>
            <p>Conception, déploiement et maintenance de vos infrastructures informatiques.</p>
            <ul>
                <li>Architecture réseau</li>
                <li>Serveurs et cloud</li>
                <li>Sécurité informatique</li>
                <li>Sauvegarde et récupération</li>
            </ul>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>