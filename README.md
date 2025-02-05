# 📚 Système de Gestion de Veille Pédagogique 🎓

Le **Système de Gestion de Veille Pédagogique** est une plateforme innovante conçue pour optimiser le rituel quotidien éducatif où les étudiants présentent des sujets techniques à leurs pairs. Cette plateforme facilite la gestion des sujets, la planification des présentations et le suivi de la participation des étudiants. 🚀

## 🌟 Fonctionnalités Requises

### 🏫 Partie Front Office

#### 👤 Visiteur
- 📅 Consulter le calendrier des présentations à venir (accès public)
- 📝 Inscription avec choix du rôle (étudiant/enseignant)
- 🔑 Système de récupération de mot de passe

#### 🎓 Étudiant
- 💡 Consulter et suggérer de nouveaux sujets
- 📊 Accéder à son tableau de bord :
  - 📅 Présentations à venir
  - 📜 Présentations passées
  - 📌 État des suggestions de sujets
- 📅 Consulter le calendrier complet des présentations
- 📧 Recevoir des notifications par email
- 🏆 Consulter le classement et les statistiques

### 🏢 Partie Back Office

#### 👨‍🏫 Enseignant
- 🔍 Examiner et approuver/rejeter les sujets suggérés
- 📝 Attribuer des sujets aux étudiants (minimum 2 étudiants par sujet)
- 📅 Gérer le calendrier des présentations
- ✅ Validation des comptes utilisateurs :
  - ✔️ Approuver/Rejeter les nouvelles inscriptions
  - ❌ Supprimer des comptes
- 📚 Gestion des sujets :
  - 🔍 Examiner tous les sujets
  - ✏️ Modifier/Supprimer les sujets inappropriés
- 📊 Accès aux statistiques globales :
  - 📈 Total des présentations effectuées
  - 🏅 Étudiants les plus actifs
  - 📊 Taux de participation des étudiants

### 🔄 Fonctionnalités Transversales
- 🔐 Système d'authentification et d'autorisation
- 📧 Système de notification par email
- 📅 Gestion du calendrier
- 📊 Génération de statistiques
- 🔍 Fonctionnalité de recherche et filtrage

## 🛠️ Exigences Techniques

### 🏗️ Architecture MVC
- 🧱 **Models** : Gestion des données et logique métier
- 🖼️ **Views** : Interface utilisateur
- 🎮 **Controllers** : Traitement des requêtes et coordination

### 🔒 Validation des Entrées
- 🛡️ Validation côté serveur avec PHP
- 🛡️ Protection contre les XSS

### 🔐 Authentification
- 🔑 Hachage des mots de passe avec `password_hash()`
- 🔒 Gestion des sessions
- 🚪 Contrôle d'accès basé sur les rôles

### 🛡️ Sécurité Base de Données
- 🛡️ Requêtes préparées
- 🛡️ Assainissement des entrées
- 🛡️ Gestion appropriée des erreurs

### 🎨 Interface Utilisateur
- 📱 Design responsive
- 🧭 Navigation claire et intuitive
- 📋 Présentation claire des informations
- ♿ Éléments de design accessibles

## 🎉 Fonctionnalités Bonus

### 🗳️ Système de Vote
- 🎯 Les étudiants peuvent voter pour les sujets approuvés
- 🏆 Classement des sujets par popularité

### 📝 Évaluations et Commentaires
- ⭐ Notation des présentations terminées
- 💬 Système de commentaires pour le feedback
- 📜 Historique des évaluations

### 📂 Ressources des Présentations
- 🔗 Stockage des liens de présentation
- 📜 Accès à l'historique des présentations
- 📥 Téléchargement des ressources

### 🏫 Gestion Multi-Classes
- 🏢 Création et gestion de classes
- 👨‍🏫 Attribution des enseignants aux classes
- 📚 Veilles spécifiques par classe
- 📊 Tableau de bord par classe

## 📊 Tableau des Fonctionnalités

| Fonctionnalité | Description | Statut |
|----------------|-------------|--------|
| Calendrier des présentations | Consulter les présentations à venir | ✅ |
| Inscription | Choix du rôle (étudiant/enseignant) | ✅ |
| Récupération de mot de passe | Système de récupération de mot de passe | ✅ |
| Suggestions de sujets | Consulter et suggérer de nouveaux sujets | ✅ |
| Tableau de bord étudiant | Accéder aux présentations à venir et passées | ✅ |
| Notifications par email | Recevoir des notifications par email | ✅ |
| Classement et statistiques | Consulter le classement et les statistiques | ✅ |
| Gestion des sujets | Examiner et approuver/rejeter les sujets | ✅ |
| Calendrier des présentations | Gérer le calendrier des présentations | ✅ |
| Validation des comptes | Approuver/Rejeter les nouvelles inscriptions | ✅ |
| Statistiques globales | Accès aux statistiques globales | ✅ |

## 📌 Prérequis

Avant de commencer, assurez-vous d’avoir installé les éléments suivants :

- 🐘 **PHP** (vérifiez avec `php -v`)
- 🖥️ **Un terminal** (CMD, Git Bash, Terminal Mac/Linux)
- 🌐 **Un navigateur web** (Chrome, Firefox, Edge...)

---

## 🚀 Installation et démarrage du projet

### 1️⃣ **Cloner le projet **
Si vous n’avez pas encore le projet, vous pouvez le cloner depuis un dépôt Git :

```

git clone https://github.com/Sala7-dine/VeilleHub.git

```

## 🚀 Démarrer le serveur PHP intégré

```
cd mon-projet-mvc
```

```
php -S localhost:8000 -t public
```

Une fois le serveur lancé, ouvrez votre navigateur et accédez à l’URL suivante :

👉 http://localhost:8000
