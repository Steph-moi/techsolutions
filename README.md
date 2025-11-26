# TechSolutions - Documentation Complète

## 📋 Table des Matières
1. [Vue d'ensemble](#vue-densemble)
2. [Structure du projet](#structure-du-projet)
3. [Base de données](#base-de-données)
4. [Authentification](#authentification)
5. [Pages publiques](#pages-publiques)
6. [Administration](#administration)
7. [API](#api)
8. [Sécurité et RGPD](#sécurité-et-rgpd)
9. [Installation](#installation)

## 🎯 Vue d'ensemble

TechSolutions est une application web PHP permettant de gérer une entreprise de solutions technologiques avec :
- Site vitrine public
- Système d'authentification utilisateur/admin
- Gestion d'actualités
- Catalogue d'ordinateurs
- Formulaire de contact
- Conformité RGPD

## 📁 Structure du projet

```
techsolutions/
├── admin/                  # Interface d'administration
│   ├── index.php          # Tableau de bord admin
│   ├── articles.php       # Gestion des actualités
│   ├── ordinateurs.php    # Gestion du catalogue
│   └── users.php          # Gestion des utilisateurs
├── api/                   # Scripts de traitement
│   ├── contact.php        # Traitement formulaire contact
│   ├── login.php          # Authentification
│   └── logout.php         # Déconnexion
├── assets/                # Ressources statiques
│   ├── css/style.css      # Styles CSS
│   ├── images/            # Images
│   └── js/main.js         # JavaScript
├── client/                # Espace client
│   └── profile.php        # Profil utilisateur
├── config/                # Configuration
│   └── database.php       # Connexion BDD
├── includes/              # Fichiers partagés
│   ├── auth.php           # Fonctions d'authentification
│   ├── header.php         # En-tête commun
│   └── footer.php         # Pied de page commun
├── index.php              # Page d'accueil
├── actualites.php         # Liste des actualités
├── contact.php            # Formulaire de contact
├── register.php           # Inscription
└── rgpd.php              # Politique de confidentialité
```

## 🗄️ Base de données

### Tables principales

#### `users` - Utilisateurs
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- email (VARCHAR(255), UNIQUE)
- password (VARCHAR(255)) - Hash bcrypt
- nom (VARCHAR(100))
- prenom (VARCHAR(100))
- telephone (VARCHAR(20))
- role (ENUM: 'client', 'admin')
- created_at (TIMESTAMP)
```

#### `articles` - Actualités
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- titre (VARCHAR(255))
- contenu (TEXT)
- auteur_id (INT, FOREIGN KEY vers users.id)
- created_at (TIMESTAMP)
```

#### `ordinateurs` - Catalogue
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- nom (VARCHAR(255))
- prix (DECIMAL(10,2))
- processeur (VARCHAR(255))
- ram (VARCHAR(100))
- stockage (VARCHAR(100))
- carte_graphique (VARCHAR(255))
- description (TEXT)
- disponible (BOOLEAN)
- created_at (TIMESTAMP)
```

#### `gdpr_logs` - Logs RGPD
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- user_id (INT, FOREIGN KEY vers users.id)
- action (VARCHAR(50))
- details (TEXT)
- created_at (TIMESTAMP)
```

## 🔐 Authentification

### Fichiers concernés
- `includes/auth.php` - Fonctions d'authentification
- `api/login.php` - Traitement connexion
- `api/logout.php` - Déconnexion
- `register.php` - Inscription

### Fonctionnalités
- **Sessions PHP** : Gestion des sessions utilisateur
- **Hachage bcrypt** : Sécurisation des mots de passe
- **Vérification des rôles** : `requireAdmin()`, `requireAuth()`
- **Navigation conditionnelle** : Affichage selon l'état de connexion

### Code clé - `includes/auth.php`
```php
function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /techsolutions/api/login.php');
        exit;
    }
}

function requireAdmin() {
    requireAuth();
    if ($_SESSION['user_role'] !== 'admin') {
        header('Location: /techsolutions/index.php');
        exit;
    }
}
```

## 🌐 Pages publiques

### `index.php` - Page d'accueil
- **Fonction** : Vitrine de l'entreprise
- **Contenu** : Services, présentation, liens vers autres sections
- **Particularité** : Section admin visible uniquement pour les administrateurs

### `actualites.php` - Liste des actualités
- **Fonction** : Affichage public des articles
- **Requête** : `SELECT * FROM articles ORDER BY created_at DESC`
- **Affichage** : Grille responsive des articles

### `contact.php` - Formulaire de contact
- **Fonction** : Collecte des demandes clients
- **Validation** : Champs obligatoires + consentement RGPD
- **Traitement** : Envoi vers `api/contact.php`
- **Feedback** : Message de succès via session

### `register.php` - Inscription
- **Fonction** : Création de compte client
- **Validation** : Email unique, mot de passe sécurisé
- **Hachage** : `password_hash()` avec bcrypt

## ⚙️ Administration

### `admin/index.php` - Tableau de bord
- **Accès** : Administrateurs uniquement
- **Fonction** : Menu principal d'administration
- **Navigation** : Liens vers gestion articles, ordinateurs, utilisateurs

### `admin/articles.php` - Gestion des actualités
- **CRUD complet** : Create, Read, Update, Delete
- **Fonctionnalités** :
  - Création/modification d'articles
  - Liste avec auteur et date
  - Suppression avec confirmation
- **Sécurité** : Vérification admin + échappement HTML

### `admin/ordinateurs.php` - Gestion du catalogue
- **CRUD complet** : Gestion des produits
- **Champs** : Nom, prix, specs techniques, disponibilité
- **Interface** : Formulaire en grille responsive
- **Statut** : Indicateur visuel disponible/indisponible

### `admin/users.php` - Gestion des utilisateurs
- **Fonctionnalités** :
  - Liste de tous les utilisateurs
  - Suppression (sauf admins)
  - Logs RGPD automatiques
- **Protection** : Comptes admin non supprimables

## 🔌 API

### `api/login.php` - Authentification
```php
// Vérification des identifiants
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];
}
```

### `api/contact.php` - Traitement contact
- **Validation** : Vérification des champs obligatoires
- **Sécurité** : Échappement des données
- **Feedback** : `$_SESSION['contact_success']` pour confirmation

### `api/logout.php` - Déconnexion
```php
session_start();
session_destroy();
header('Location: /techsolutions/index.php');
```

## 🛡️ Sécurité et RGPD

### Mesures de sécurité
- **Mots de passe** : Hachage bcrypt
- **Sessions** : Gestion sécurisée des sessions
- **SQL** : Requêtes préparées (protection injection)
- **XSS** : `htmlspecialchars()` sur toutes les sorties
- **CSRF** : Vérification des rôles et permissions

### Conformité RGPD
- **Consentement** : Checkbox obligatoire sur formulaires
- **Logs** : Traçabilité des actions sur les données (`gdpr_logs`)
- **Politique** : Page dédiée `rgpd.php`
- **Suppression** : Possibilité de supprimer les comptes

### `rgpd.php` - Politique de confidentialité
- **Contenu** : Informations sur la collecte de données
- **Droits** : Explication des droits utilisateur
- **Contact** : Moyens d'exercer ses droits

## 🚀 Installation

### Prérequis
- **Serveur** : Apache/Nginx avec PHP 7.4+
- **Base de données** : MySQL 5.7+ ou MariaDB
- **Extensions PHP** : PDO, PDO_MySQL

### Étapes d'installation

1. **Cloner le projet**
```bash
git clone [repository-url] techsolutions
cd techsolutions
```

2. **Configuration base de données**
```php
// config/database.php
$host = 'localhost';
$dbname = 'techsolutions';
$username = 'root';
$password = '';
```

3. **Créer la base de données**
```sql
-- Importer le fichier schema.sql ou database.sql
mysql -u root -p techsolutions < database.sql
```

4. **Créer un compte admin**
```sql
INSERT INTO users (email, password, nom, prenom, role) 
VALUES ('admin@techsolutions.com', '$2y$10$...', 'Admin', 'System', 'admin');
```

5. **Permissions**
```bash
chmod 755 techsolutions/
chmod 644 techsolutions/*.php
```

### Configuration serveur web

#### Apache (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

#### Nginx
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## 🎨 Styles et Interface

### `assets/css/style.css`
- **Design** : Interface moderne et responsive
- **Couleurs** : Palette professionnelle (bleu/gris)
- **Composants** : Formulaires, tableaux, cartes, alertes
- **Mobile** : Adaptation tablette/smartphone

### Composants principaux
- **Navigation** : Menu responsive avec logo
- **Formulaires** : Styles uniformes avec validation
- **Tableaux** : Interface admin avec actions
- **Alertes** : Messages de succès/erreur
- **Cartes** : Affichage services et articles

## 🔧 Maintenance

### Logs et monitoring
- **Erreurs PHP** : Vérifier les logs serveur
- **Base de données** : Surveiller les performances
- **RGPD** : Consulter `gdpr_logs` régulièrement

### Sauvegardes
```bash
# Base de données
mysqldump -u root -p techsolutions > backup_$(date +%Y%m%d).sql

# Fichiers
tar -czf techsolutions_$(date +%Y%m%d).tar.gz techsolutions/
```

### Mises à jour
1. Sauvegarder base et fichiers
2. Tester en environnement de développement
3. Déployer les modifications
4. Vérifier le bon fonctionnement

---

**Version** : 1.0  
**Dernière mise à jour** : $(date +%Y-%m-%d)  
**Développeur** : TechSolutions Team