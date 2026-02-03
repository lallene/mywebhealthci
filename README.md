# 🏥 MyWebHealth - Gestion de Santé

Ce projet est une application de gestion de santé développée avec **Laravel**. Initialement conçue sous **PHP 7.3**, elle a été entièrement migrée vers **PHP 8.2** et modernisée grâce à la conteneurisation.

## 🚀 Points Forts de la Migration
- **Mise à niveau technique** : Passage de PHP 7.3 à PHP 8.2.
- **Environnement Docker** : Mise en place d'une architecture multi-conteneurs (App, Web, DB).
- **Correction de bugs critiques** : Résolution des erreurs de typage PHP 8.2 (notamment sur les fonctions mathématiques et de dates).
- **Sécurisation** : Utilisation de variables d'environnement et nettoyage des accès sensibles.

## 🛠️ Stack Technique
- **Framework** : Laravel 8.x
- **Langage** : PHP 8.2
- **Base de données** : MariaDB / MySQL
- **Infrastructure** : Docker & Docker Compose

## 📦 Installation avec Docker

1. **Cloner le projet** :
   ```bash
   git clone [https://github.com/lallene/mywebhealthci.git](https://github.com/lallene/mywebhealthci.git)
   cd mywebhealthci