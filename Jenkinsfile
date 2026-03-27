pipeline {
    agent any

    environment {
        NEXUS_HOST      = "host.docker.internal:5000"
        IMAGE_APACHE    = "host.docker.internal:5000/transitflow-apache"
        IMAGE_PHP       = "host.docker.internal:5000/transitflow-php"
        DOCKER_BUILDKIT = "0"   // ← désactive BuildKit
    }

    stages {
        stage('Checkout') {
            steps {
                deleteDir()
                echo 'Récupération du code...'
                checkout scm
            }
        }

        stage('Build images') {
            steps {
                sh "docker build --network=host -t ${IMAGE_APACHE}:latest ./docker/apache"
                sh "docker build --network=host -t ${IMAGE_PHP}:latest ./docker/php"
            }
        }

        stage('Push Nexus') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'nexus-credentials',
                    usernameVariable: 'NEXUS_USER',
                    passwordVariable: 'NEXUS_PASS'
                )]) {
                    sh 'echo "$NEXUS_PASS" | docker login host.docker.internal:5000 -u "$NEXUS_USER" --password-stdin'
                    sh "docker push ${IMAGE_APACHE}:latest"
                    sh "docker push ${IMAGE_PHP}:latest"
                    sh "docker logout host.docker.internal:5000"
                }
            }
        }

        stage('Deploy') {
            steps {
                sh 'docker-compose down || true'
                sh 'docker-compose up -d'
            }
        }
    }

    post {
        success { echo 'TransitFlow déployé avec succès !' }
        failure { echo 'Échec du pipeline.' }
    }
}