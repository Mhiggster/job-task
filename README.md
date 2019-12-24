# choco-task
Тестовое задание

## Установка

Для запуска проекта понадобиться composer [composer](https://getcomposer.org/)

Клонируем репозиторий

    git clone git@github.com:Mhiggster/job-task.git app

Переходим в проект и устанавливаем

    cd app/ && composer dump-autoload

Настраиваем подключение к базе

    configs/database.php
    
Если используете docker
    
    docker-compose up -d 
