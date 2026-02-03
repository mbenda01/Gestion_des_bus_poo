# 🐳 Projet Docker - Environnement PHP/PostgreSQL

Configuration complète d'un environnement Docker avec Apache, PHP-FPM, PostgreSQL et pgAdmin, avec CI/CD via GitHub Actions et notifications Slack.

## 📋 Services inclus

- **Apache** (port 80 & 443) - Serveur web avec support SSL
- **PHP-FPM 8.2** - Interpréteur PHP
- **PostgreSQL 16** (port 5432) - Base de données
- **pgAdmin** (port 54) - Interface d'administration PostgreSQL

## 🚀 Installation et Démarrage

### Prérequis
- Docker Desktop installé
- Git installé
- Compte Docker Hub
- Compte GitHub
- Workspace Slack (optionnel)

### Étape 1 : Cloner le projet
```bash
git clone <votre-repo>
cd <votre-projet>
```

### Étape 2 : Créer la structure des dossiers
```bash
mkdir -p docker/apache docker/php public
```

### Étape 3 : Créer un fichier index.php de test
```bash
cat > public/index.php << 'EOF'
<?php
phpinfo();
EOF
```

### Étape 4 : Lancer l'environnement
```bash
docker-compose up -d --build
```

### Étape 5 : Vérifier les services
```bash
docker-compose ps
```

## 🌐 Accès aux services

| Service | URL | Identifiants |
|---------|-----|-------------|
| Application HTTP | http://localhost | - |
| Application HTTPS | https://localhost | - |
| pgAdmin | http://localhost:54 | admin@local.com / root |
| PostgreSQL | localhost:5432 | postgres / root |

### Configuration de pgAdmin

1. Accédez à http://localhost:54
2. Connectez-vous avec `admin@local.com` / `root`
3. Ajoutez un nouveau serveur :
   - **Name**: IIBS Postgres
   - **Host**: iibs_postgres
   - **Port**: 5432
   - **Username**: postgres
   - **Password**: root

## 🔐 Configuration SSL

Le certificat SSL est auto-signé et généré automatiquement au build. Votre navigateur affichera un avertissement de sécurité - c'est normal pour un certificat auto-signé.

Pour accepter le certificat :
- **Chrome/Edge**: Cliquez sur "Avancé" puis "Continuer vers localhost"
- **Firefox**: Cliquez sur "Avancé" puis "Accepter le risque et continuer"

### Utiliser un certificat personnalisé

1. Placez vos fichiers `server.crt` et `server.key` dans `docker/apache/ssl/`
2. Modifiez le Dockerfile Apache pour ne pas générer de certificat
3. Rebuild le container : `docker-compose up -d --build iibs_apache`

## 🔄 Configuration CI/CD avec GitHub Actions

### Étape 1 : Créer les secrets GitHub

Allez dans votre repository GitHub → **Settings** → **Secrets and variables** → **Actions** → **New repository secret**

Créez ces secrets :

1. **DOCKER_USERNAME** : Votre nom d'utilisateur Docker Hub
2. **DOCKER_PASSWORD** : Votre token d'accès Docker Hub
3. **SLACK_WEBHOOK_URL** : L'URL du webhook Slack (optionnel)

### Étape 2 : Obtenir le token Docker Hub

1. Connectez-vous à https://hub.docker.com
2. Allez dans **Account Settings** → **Security** → **New Access Token**
3. Nommez-le (ex: "github-actions") et copiez le token
4. Utilisez ce token comme **DOCKER_PASSWORD**

### Étape 3 : Configuration Slack (optionnel)

#### Créer un webhook Slack :

1. Allez sur https://api.slack.com/apps
2. Cliquez sur **Create New App** → **From scratch**
3. Donnez un nom (ex: "Docker CI/CD") et sélectionnez votre workspace
4. Dans la sidebar, allez à **Incoming Webhooks**
5. Activez **Activate Incoming Webhooks**
6. Cliquez sur **Add New Webhook to Workspace**
7. Sélectionnez le channel où vous voulez les notifications
8. Copiez le **Webhook URL**
9. Ajoutez cette URL comme secret **SLACK_WEBHOOK_URL** dans GitHub

### Étape 4 : Tester le workflow

```bash
git add .
git commit -m "feat: Configure CI/CD pipeline"
git push origin main
```

Le workflow se déclenchera automatiquement et vous recevrez une notification Slack.

## 📦 Workflow GitHub Actions

Le workflow fait automatiquement :

1. ✅ Checkout du code
2. 🔐 Connexion à Docker Hub
3. 🏗️ Build de l'image Docker
4. 📤 Push vers Docker Hub avec les tags :
   - `latest` (branche par défaut)
   - Nom de la branche
   - SHA du commit
5. 📢 Notification Slack (succès ou échec)

## 🛠️ Commandes utiles

### Gestion des containers
```bash
# Démarrer les services
docker-compose up -d

# Arrêter les services
docker-compose down

# Voir les logs
docker-compose logs -f

# Logs d'un service spécifique
docker-compose logs -f iibs_apache

# Rebuild les images
docker-compose up -d --build

# Entrer dans un container
docker exec -it iibs_php bash
docker exec -it iibs_apache bash
docker exec -it iibs_postgres bash
```

### Gestion de la base de données
```bash
# Se connecter à PostgreSQL
docker exec -it iibs_postgres psql -U postgres -d gestiondesbuspoo

# Backup de la base
docker exec iibs_postgres pg_dump -U postgres gestiondesbuspoo > backup.sql

# Restore de la base
docker exec -i iibs_postgres psql -U postgres gestiondesbuspoo < backup.sql
```

### Nettoyage
```bash
# Supprimer tous les containers et volumes
docker-compose down -v

# Nettoyer les images non utilisées
docker image prune -a

# Nettoyer complètement Docker
docker system prune -a --volumes
```

## 📁 Structure du projet

```
.
├── .github/
│   └── workflows/
│       └── docker-build-push.yml    # Workflow GitHub Actions
├── docker/
│   ├── apache/
│   │   ├── Dockerfile               # Image Apache
│   │   ├── 000-default.conf         # Config HTTP
│   │   └── ssl-default.conf         # Config HTTPS
│   └── php/
│       └── Dockerfile               # Image PHP-FPM
├── public/
│   └── index.php                    # Point d'entrée
├── docker-compose.yml               # Configuration des services
├── Dockerfile                       # Image pour Docker Hub
└── .dockerignore                    # Fichiers à exclure
```

## 🐛 Résolution de problèmes

### Port déjà utilisé
```bash
# Trouver le processus utilisant le port
sudo lsof -i :80
sudo lsof -i :443

# Changer le port dans docker-compose.yml
ports:
  - "8080:80"  # Au lieu de "80:80"
```

### Permission denied sur les fichiers
```bash
# Depuis votre machine hôte
sudo chown -R $USER:$USER .

# Depuis le container
docker exec -it iibs_php chown -R www-data:www-data /var/www/html
```

### Erreur de connexion PostgreSQL
```bash
# Vérifier que le container est démarré
docker-compose ps

# Vérifier les logs
docker-compose logs iibs_postgres

# Tester la connexion
docker exec -it iibs_postgres psql -U postgres -c "SELECT version();"
```

### Les notifications Slack ne fonctionnent pas

1. Vérifiez que le webhook URL est correct
2. Vérifiez que le secret est bien configuré dans GitHub
3. Testez le webhook manuellement :
```bash
curl -X POST -H 'Content-type: application/json' \
--data '{"text":"Test de notification"}' \
YOUR_WEBHOOK_URL
```

## 🔒 Connexion à distance PostgreSQL

Pour autoriser les connexions à distance :

1. Modifiez `docker-compose.yml` :
```yaml
iibs_postgres:
  ports:
    - "5432:5432"  # Accessible depuis l'extérieur
```

2. Utilisez ces paramètres de connexion :
   - **Host**: Votre IP publique ou localhost
   - **Port**: 5432
   - **Database**: gestiondesbuspoo
   - **Username**: postgres
   - **Password**: root

⚠️ **Attention** : Pour la production, changez le mot de passe et utilisez des variables d'environnement !

## 📝 Variables d'environnement (Production)

Créez un fichier `.env` :

```env
POSTGRES_DB=gestiondesbuspoo
POSTGRES_USER=postgres
POSTGRES_PASSWORD=VotreMotDePasseSecurise
PGADMIN_EMAIL=admin@votre-domaine.com
PGADMIN_PASSWORD=VotreMotDePasseSecurise
```

Modifiez `docker-compose.yml` :
```yaml
environment:
  POSTGRES_DB: ${POSTGRES_DB}
  POSTGRES_USER: ${POSTGRES_USER}
  POSTGRES_PASSWORD: ${POSTGRES_PASSWORD}
```

## 📚 Ressources

- [Documentation Docker](https://docs.docker.com/)
- [Documentation Docker Compose](https://docs.docker.com/compose/)
- [GitHub Actions](https://docs.github.com/en/actions)
- [Slack API](https://api.slack.com/)

## 🤝 Support

Pour toute question ou problème, contactez votre professeur ou créez une issue sur le repository GitHub.

## 📄 Licence

Ce projet est destiné à un usage éducatif.