# 🚀 Guide de Démarrage Rapide

## Installation en 3 étapes

### 1️⃣ Préparation
```bash
# Cloner le projet
git clone <votre-repo>
cd <votre-projet>

# Créer le dossier public s'il n'existe pas
mkdir -p public

# Créer un fichier de test
echo "<?php phpinfo();" > public/index.php
```

### 2️⃣ Lancement
```bash
# Option A : Avec le script automatique
./deploy.sh

# Option B : Manuellement
docker-compose up -d --build
```

### 3️⃣ Vérification
Ouvrez votre navigateur :
- http://localhost → Votre application
- https://localhost → Votre application (SSL)
- http://localhost:54 → pgAdmin

## 🔧 Configuration GitHub Actions + Docker Hub

### Étape 1 : Obtenir votre token Docker Hub
1. Allez sur https://hub.docker.com
2. Account Settings → Security → New Access Token
3. Copiez le token généré

### Étape 2 : Configurer les secrets GitHub
Dans votre repo GitHub : **Settings** → **Secrets and variables** → **Actions**

Ajoutez :
- `DOCKER_USERNAME` : Votre username Docker Hub
- `DOCKER_PASSWORD` : Le token de l'étape 1
- `SLACK_WEBHOOK_URL` : (optionnel) Votre webhook Slack

### Étape 3 : Modifier le nom de l'image
Dans `.github/workflows/docker-build-push.yml`, ligne 15 :
```yaml
IMAGE_NAME: votre-username/nom-de-votre-image
```

### Étape 4 : Push et test
```bash
git add .
git commit -m "Setup CI/CD"
git push origin main
```

GitHub Actions va automatiquement :
- ✅ Builder votre image
- ✅ La pousser sur Docker Hub
- ✅ Vous notifier sur Slack

## 📱 Configuration Slack (optionnel)

### Créer un webhook :
1. https://api.slack.com/apps → Create New App
2. From scratch → Nommez-le "Docker CI/CD"
3. Incoming Webhooks → Activate
4. Add New Webhook to Workspace
5. Choisissez un channel
6. Copiez l'URL du webhook
7. Ajoutez-la comme secret dans GitHub

## 🆘 Problèmes courants

### Port 80 déjà utilisé
```bash
# Dans docker-compose.yml, changez :
ports:
  - "8080:80"  # Au lieu de 80:80
```

### Erreur de permission
```bash
sudo chown -R $USER:$USER .
```

### Container qui ne démarre pas
```bash
# Voir les logs
docker-compose logs nom-du-service

# Exemples :
docker-compose logs iibs_apache
docker-compose logs iibs_postgres
```

## 📝 Commandes essentielles

```bash
# Démarrer
docker-compose up -d

# Arrêter
docker-compose down

# Voir les logs
docker-compose logs -f

# Rebuild
docker-compose up -d --build

# Nettoyer
docker-compose down -v
docker system prune -a
```

## ✅ Checklist avant de soumettre

- [ ] Les containers démarrent sans erreur
- [ ] L'application est accessible sur http://localhost
- [ ] pgAdmin fonctionne sur http://localhost:54
- [ ] Les secrets GitHub sont configurés
- [ ] Le workflow GitHub Actions passe au vert
- [ ] Les notifications Slack arrivent (si configurées)
- [ ] Le README est à jour

Bon courage ! 🎓