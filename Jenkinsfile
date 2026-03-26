pipeline {
    agent any

    environment {
        IMAGE_APACHE = "localhost:5000/transitflow-apache"
        IMAGE_PHP    = "localhost:5000/transitflow-php"
    }


    stages {
        stage('Checkout') {
            steps {
                echo 'Récupération du code...'
                checkout scm
            }
        }

        stage('Build images') {
            steps {
                sh "docker build -t ${IMAGE_APACHE}:latest ./docker/apache"
                sh "docker build -t ${IMAGE_PHP}:latest ./docker/php"
            }
        }

        stage('Push Nexus') {
            steps {
                sh "docker push ${IMAGE_APACHE}:latest"
                sh "docker push ${IMAGE_PHP}:latest"
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
        success { echo 'TransitFlow deploye avec succès !' }
        failure { echo 'Echec du pipeline.' }
    }
}
