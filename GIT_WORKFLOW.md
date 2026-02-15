# Stratégie Git - Projet Arcadia Zoo

## Structure des branches

Ce projet utilise une stratégie de branches pour organiser le développement.

### Branches principales

- **main** : Branche de production avec le code stable
- **develop** : Branche de développement pour intégrer les nouvelles fonctionnalités

### Branches par fonctionnalité

Chaque fonctionnalité du projet a sa propre branche :

- **feature/authentification** : Système de connexion avec 3 rôles (admin, employé, vétérinaire)
- **feature/habitats** : Gestion des habitats (création, modification, suppression)
- **feature/animaux** : Gestion des animaux avec images
- **feature/services** : Gestion des services du zoo
- **feature/avis** : Système d'avis des visiteurs
- **feature/contact** : Formulaire de contact
- **feature/dashboard-admin** : Interface administrateur
- **feature/dashboard-employe** : Interface employé
- **feature/dashboard-veterinaire** : Interface vétérinaire
- **feature/statistiques** : Statistiques de consultation avec MongoDB

## Workflow utilisé

1. Développement des fonctionnalités sur les branches feature/*
2. Intégration sur la branche develop
3. Validation et tests
4. Merge sur main pour la production

## Note importante

La structure de branches a été mise en place pour organiser le développement futur du projet et suivre les bonnes pratiques Git.
