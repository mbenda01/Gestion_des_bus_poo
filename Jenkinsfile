pipeline {
    agent any

    environment {
        NEXUS_HOST   = "172.17.0.3:5000"
        IMAGE_APACHE = "172.17.0.3:5000/transitflow-apache"
        IMAGE_PHP    = "172.17.0.3:5000/transitflow-php"
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
                withCredentials([usernamePassword(
                    credentialsId: 'nexus-credentials',
                    usernameVariable: 'NEXUS_USER',
                    passwordVariable: 'NEXUS_PASS'
                )]) {
                    sh "echo $NEXUS_PASS | docker login ${NEXUS_HOST} -u $NEXUS_USER --password-stdin"
                    sh "docker push ${IMAGE_APACHE}:latest"
                    sh "docker push ${IMAGE_PHP}:latest"
                    sh "docker logout ${NEXUS_HOST}"
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