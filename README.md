# MediaTek Formations - Application Web

## Description

Ce projet est une application web développée en Symfony, permettant de gérer des formations en ligne pour le réseau MediaTek86. L'application repose sur une base de données MySQL et inclut un back-office pour l'administration des niveaux de difficulté et des formations.

Le contexte est celui d'un réseau de médiathèques qui fédère les prêts de livres, DVD, CD et propose des auto-formations en ligne.

## Fonctionnalités

- **Gestion des formations** : Ajout, modification, suppression et affichage des formations disponibles.
- **Gestion des niveaux de difficulté** : Trois niveaux disponibles (Facile, Moyen, Difficile).
- **Recherche et filtrage des formations** : Tri par niveaux et recherches avancées.
- **Back-office sécurisé** : Interface d'administration accessible après authentification.
- **Sécurisation CSRF** : Protection des formulaires avec tokens CSRF.
- **Test unitaire** : Test de la fonctionnalité "date de parution" pour les formations.

## Structure de la Base de Données

Le projet utilise une base de données MySQL. Voici un extrait de la structure de la base utilisée pour les formations :

```sql
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published_at` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `niveau_id` int(11),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `niveau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);
