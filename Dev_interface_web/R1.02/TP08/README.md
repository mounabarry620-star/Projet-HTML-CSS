# Site Culinaire Dynamique avec PHP et MySQL

Ce projet est une version dynamique du site culinaire utilisant PHP et MySQL pour gérer les recettes.

## Structure du Projet

- `config.php` - Configuration de la base de données et connexion
- `recettes.php` - Page principale affichant toutes les recettes
- `recette.php` - Page détaillée pour une recette individuelle
- `index.php` - Page d'accueil
- `decouvrir.php` - Page "À propos"
- `test_db.php` - Script de test pour vérifier la connexion à la base de données

## Prérequis

1. **Serveur web local** : XAMPP, WAMP, MAMP ou LAMP
2. **PHP** : Version 7.4 ou supérieure
3. **MySQL/MariaDB** : Pour la base de données

## Installation

### 1. Installer XAMPP

Téléchargez et installez XAMPP depuis [https://www.apachefriends.org/fr/index.html](https://www.apachefriends.org/fr/index.html)

### 2. Démarrer les services

Lancez le panneau de contrôle XAMPP et démarrez :
- **Apache** (serveur web)
- **MySQL** (base de données)

### 3. Configurer le projet

Placez le dossier `TP08` dans le répertoire `htdocs` de XAMPP :
```
C:\xampp\htdocs\TP08\   (Windows)
/opt/lampp/htdocs/TP08/ (Linux/Mac)
```

### 4. Accéder au site

Ouvrez votre navigateur et allez à :
```
http://localhost/TP08/
```

### 5. Tester la base de données

Accédez à la page de test pour vérifier que tout fonctionne :
```
http://localhost/TP08/test_db.php
```

## Fonctionnalités

### Base de données
- **Table `recettes`** : Contient toutes les informations sur les recettes
  - `id` : Identifiant unique
  - `titre` : Nom de la recette
  - `photo` : Nom du fichier image
  - `note` : Évaluation (1-5)
  - `description_courte` : Résumé
  - `description_longue` : Détails complets

### Fonctionnalités PHP
- **Connexion automatique** : Le script crée la base de données si elle n'existe pas
- **Insertion de données** : Les recettes sont ajoutées automatiquement si la table est vide
- **Tri dynamique** : Possibilité de trier les recettes par nom ou par note
- **Pages détaillées** : Chaque recette a sa propre page avec tous les détails

## Utilisation

1. **Page d'accueil** : `index.php` - Présentation du site
2. **Liste des recettes** : `recettes.php` - Toutes les recettes avec tri
3. **Détail d'une recette** : `recette.php?id=1` - Page détaillée
4. **À propos** : `decouvrir.php` - Informations sur le site

## Options de tri

- `recettes.php?sort=name_asc` - Trier par nom (A-Z)
- `recettes.php?sort=name_desc` - Trier par nom (Z-A)
- `recettes.php?sort=rating_asc` - Trier par note (1-5)
- `recettes.php?sort=rating_desc` - Trier par note (5-1)

## Résolution des problèmes

Si vous rencontrez des problèmes de connexion à la base de données :

1. Vérifiez que MySQL est démarré dans XAMPP
2. Modifiez les informations de connexion dans `config.php` si nécessaire
3. Assurez-vous que le port MySQL (généralement 3306) n'est pas bloqué

## Sécurité

Pour un environnement de production :
- Changez les identifiants de la base de données
- Ajoutez une validation des entrées utilisateur
- Implémentez un système d'authentification

---

© 2025 Mon Site Culinaire - Tous droits réservés