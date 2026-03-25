pipeline {
    agent any

    environment {
        IMAGE_APACHE = "mbenda01/transitflow-apache"
        IMAGE_PHP    = "mbenda01/transitflow-php"
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

        stage('Push Docker Hub') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'dockerhub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh "echo $DOCKER_PASS | docker login -u $DOCKER_USER --password-stdin"
                    sh "docker push ${IMAGE_APACHE}:latest"
                    sh "docker push ${IMAGE_PHP}:latest"
                }
            }
        }

        stage('Deploy') {
            steps {
                sh 'docker-compose down || true'
                sh 'docker-compose up -d --build'
            }
        }
    }

    post {
        success { echo 'TransitFlow deploye avec succès !' }
        failure { echo 'Echec du pipeline.' }
    }
}
