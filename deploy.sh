#!/bin/bash

# Script de déploiement automatique
# Utilisation : ./deploy.sh

set -e

echo "🚀 Démarrage du déploiement..."

# Couleurs pour les messages
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Fonction pour afficher les messages
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# Vérification que Docker est installé
if ! command -v docker &> /dev/null; then
    print_error "Docker n'est pas installé. Veuillez l'installer d'abord."
    exit 1
fi

print_success "Docker est installé"

# Vérification que Docker Compose est installé
if ! command -v docker-compose &> /dev/null; then
    print_error "Docker Compose n'est pas installé. Veuillez l'installer d'abord."
    exit 1
fi

print_success "Docker Compose est installé"

# Arrêt des containers existants
print_warning "Arrêt des containers existants..."
docker-compose down 2>/dev/null || true

# Nettoyage des images non utilisées
print_warning "Nettoyage des images non utilisées..."
docker image prune -f

# Création du dossier public s'il n'existe pas
if [ ! -d "public" ]; then
    print_warning "Création du dossier public..."
    mkdir -p public
fi

# Création du fichier index.php de test s'il n'existe pas
if [ ! -f "public/index.php" ]; then
    print_warning "Création du fichier index.php de test..."
    cat > public/index.php << 'EOF'
<?php
echo "<h1>🎉 Environnement Docker opérationnel !</h1>";
echo "<h2>Informations PHP</h2>";
phpinfo();
EOF
    print_success "Fichier index.php créé"
fi

# Build et démarrage des containers
print_warning "Build et démarrage des containers..."
docker-compose up -d --build

# Attente que les services soient prêts
print_warning "Attente du démarrage des services..."
sleep 10

# Vérification de l'état des containers
print_warning "Vérification de l'état des containers..."
docker-compose ps

echo ""
print_success "✨ Déploiement terminé !"
echo ""
echo "📋 Accès aux services :"
echo "   - Application HTTP:  http://localhost"
echo "   - Application HTTPS: https://localhost (certificat auto-signé)"
echo "   - pgAdmin:           http://localhost:54"
echo "   - PostgreSQL:        localhost:5432"
echo ""
echo "🔐 Identifiants pgAdmin :"
echo "   - Email:    admin@local.com"
echo "   - Password: root"
echo ""
echo "🔐 Identifiants PostgreSQL :"
echo "   - User:     postgres"
echo "   - Password: root"
echo "   - Database: gestiondesbuspoo"
echo ""
echo "📊 Voir les logs : docker-compose logs -f"
echo "🛑 Arrêter : docker-compose down"
echo ""