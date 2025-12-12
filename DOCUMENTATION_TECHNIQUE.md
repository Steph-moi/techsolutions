# Documentation Technique - Site Vitrine TechSolutions

## 4.1 Architecture et Technologies

Le site vitrine TechSolutions a été conçu selon une architecture Client-Serveur moderne, respectant les bonnes pratiques de développement web pour garantir la sécurité, la performance et la maintenabilité.

### Front-End (Interface Utilisateur) :

**HTML5** : Structure sémantique des pages avec balises appropriées (Header, Nav, Section, Footer, Article).

**CSS3** : Mise en forme responsive avec Grid et Flexbox, adaptée aux mobiles, tablettes et desktop. Charte graphique cohérente avec palette de couleurs professionnelle.

**JavaScript** : Interactions dynamiques légères (navigation mobile, validation formulaires côté client).

### Back-End (Logique Serveur) :

**PHP 8.2** : Traitement des formulaires, authentification, gestion des sessions et interactions base de données.

**Architecture MVC Simplifiée** : Séparation claire entre logique métier (PHP), présentation (HTML/CSS) et données (MySQL).

**PDO (PHP Data Objects)** : Couche d'abstraction pour les interactions sécurisées avec la base de données.

### Base de Données :

**MySQL 8.0** : Stockage relationnel optimisé avec moteur InnoDB pour les transactions ACID.

## 4.2 Structure de la Base de Données (MySQL)

La base de données `techsolutions` contient les tables suivantes :

### 1. Table `users` (Gestion des accès)
Gère les administrateurs et clients avec authentification sécurisée.

```sql
id (INT, Primary Key, Auto-increment)
email (VARCHAR(255), Unique) : Identifiant de connexion
password (VARCHAR(255)) : Mot de passe haché (Bcrypt)
nom (VARCHAR(100)) : Nom de famille
prenom (VARCHAR(100)) : Prénom
role (ENUM('admin', 'client')) : Rôle utilisateur
created_at (TIMESTAMP) : Date de création
```

### 2. Table `articles` (Section Actualités)
Permet l'affichage dynamique des actualités avec gestion des auteurs.

```sql
id (INT, Primary Key, Auto-increment)
titre (VARCHAR(255)) : Titre de l'actualité
contenu (TEXT) : Corps de l'article
auteur_id (INT, Foreign Key → users.id) : Référence auteur
created_at (TIMESTAMP) : Date de publication
```

### 3. Table `ordinateurs` (Parc Informatique)
Catalogue des configurations PC avec spécifications techniques.

```sql
id (INT, Primary Key, Auto-increment)
nom (VARCHAR(255)) : Nom de la configuration
prix (DECIMAL(10,2)) : Prix en euros
processeur (VARCHAR(255)) : Spécifications CPU
ram (VARCHAR(100)) : Mémoire vive
stockage (VARCHAR(255)) : Type et capacité stockage
carte_graphique (VARCHAR(255)) : GPU ou intégré
description (TEXT) : Description détaillée
photo (VARCHAR(255)) : Nom fichier image
disponible (BOOLEAN) : Statut disponibilité
created_at (TIMESTAMP) : Date d'ajout
```

### 4. Table `components` (Composants Techniques)
Base de données des composants informatiques pour configurations.

```sql
id (INT, Primary Key, Auto-increment)
nom (VARCHAR(255)) : Nom du composant
type (VARCHAR(100)) : Catégorie (Processeur, RAM, etc.)
prix (DECIMAL(10,2)) : Prix unitaire
description (TEXT) : Spécifications techniques
created_at (TIMESTAMP) : Date d'ajout
```

### 5. Table `gdpr_logs` (Conformité RGPD)
Traçabilité des actions utilisateurs sur leurs données personnelles.

```sql
id (INT, Primary Key, Auto-increment)
user_id (INT, Foreign Key → users.id) : Utilisateur concerné
action (VARCHAR(50)) : Type d'action (view, update, delete)
details (TEXT) : Détails de l'action
created_at (TIMESTAMP) : Horodatage
```

## 4.3 Sécurité et Conformité RGPD

### Mesures de Sécurité Implémentées :

**Authentification Sécurisée** : 
- Mots de passe hachés avec `password_hash()` (Algorithme Bcrypt)
- Sessions PHP sécurisées avec régénération d'ID
- Contrôle d'accès basé sur les rôles (RBAC)

**Protection contre les Vulnérabilités** :
- **Injections SQL** : Requêtes préparées PDO systématiques
- **XSS** : Échappement avec `htmlspecialchars()` sur toutes les sorties
- **CSRF** : Tokens de validation sur les formulaires sensibles

**Conformité RGPD** :
- Interface dédiée (`rgpd.php`) pour gestion des données personnelles
- Droit d'accès, rectification et effacement (Articles 15, 16, 17)
- Logs d'audit dans `gdpr_logs` pour traçabilité
- Consentement explicite pour traitement des données

## 4.4 Arborescence des Fichiers

Organisation modulaire pour faciliter la maintenance et les évolutions :

```
/techsolutions (racine)
├── /admin                    # Panel d'administration
│   ├── index.php            # Tableau de bord admin
│   ├── articles.php         # Gestion actualités
│   ├── ordinateurs.php      # Gestion parc informatique
│   ├── components.php       # Gestion composants
│   └── users.php            # Gestion utilisateurs
├── /api                     # Endpoints API
│   ├── login.php           # Authentification
│   ├── logout.php          # Déconnexion
│   └── contact.php         # Traitement formulaire contact
├── /assets                  # Ressources statiques
│   ├── /css
│   │   └── style.css       # Feuille de style principale
│   ├── /images
│   │   └── techsolution.png # Logo entreprise
│   └── /js
│       └── main.js         # Scripts JavaScript
├── /BDD                     # Base de données
│   └── techsolutions.sql   # Structure et données initiales
├── /client                  # Espace client
│   └── profile.php         # Profil utilisateur
├── /config                  # Configuration
│   └── database.php        # Connexion BDD sécurisée
├── /includes               # Fichiers partagés
│   ├── auth.php           # Fonctions authentification
│   ├── header.php         # En-tête commun
│   └── footer.php         # Pied de page commun
├── /uploads               # Fichiers uploadés
│   └── (photos PC)        # Images configurations
├── index.php              # Page d'accueil
├── actualites.php         # Page actualités dynamique
├── services.php           # Page services
├── contact.php            # Formulaire de contact
├── register.php           # Inscription utilisateurs
├── rgpd.php              # Interface RGPD
└── README.md             # Documentation projet
```

## 4.5 Fonctionnalités Principales

### Interface Publique :
- **Accueil** : Présentation configurations PC avec prix et spécifications
- **Services** : Développement, support, infrastructure
- **Actualités** : Articles dynamiques avec système d'auteurs
- **Contact** : Formulaire avec informations entreprise

### Panel Administrateur :
- **Gestion Actualités** : CRUD complet avec éditeur
- **Parc Informatique** : Gestion configurations PC avec photos
- **Composants** : Base de données composants techniques
- **Utilisateurs** : Administration comptes clients/admins

### Espace Client :
- **Profil** : Consultation et modification données personnelles
- **RGPD** : Exercice des droits (accès, rectification, effacement)

## 4.6 Déploiement et Maintenance

### Prérequis Serveur :
- PHP 8.2+ avec extensions PDO, MySQL
- MySQL 8.0+ ou MariaDB 10.6+
- Apache 2.4+ avec mod_rewrite
- HTTPS obligatoire (certificat SSL/TLS)

### Configuration Recommandée :
- Environnement LAMP/WAMP sécurisé
- Sauvegardes automatisées base de données
- Logs d'erreurs activés pour monitoring
- Mise à jour sécurité régulière

Cette architecture garantit un site performant, sécurisé et évolutif, respectant les standards modernes du développement web.