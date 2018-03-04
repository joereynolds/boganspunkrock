pipeline {
  agent any
  stages {
    stage('Pull Bogans') {
      steps {
        sh '''cd /var/www/staging-boganspunkrockn
git pull origin master'''
      }
    }
    stage('Composer install') {
      steps {
        dir(path: '/var/www/staging-boganspunkrockn/bogans') {
          sh 'composer install'
        }
        
      }
    }
    stage('Run migrations') {
      steps {
        dir(path: '/var/www/staging-boganspunkrockn/bogans') {
          sh '''php bin/console doctrine:migrations:migrate
'''
        }
        
      }
    }
    stage('Clear the cache') {
      steps {
        dir(path: '/var/www/staging-boganspunkrockn/bogans') {
          sh '''php bin/console cache:clear --env=prod
'''
        }
        
      }
    }
    stage('Fix ownership') {
      steps {
        sh '''sudo chown -R jenkins:jenkins . 
'''
      }
    }
    stage('Run tests') {
      steps {
        dir(path: '/var/www/staging-boganspunkrockn/bogans') {
          sh '''/home/joe/.composer/vendor/phpunit/phpunit/phpunit
'''
        }
        
      }
    }
  }
  environment {
    Staging = ''
  }
}