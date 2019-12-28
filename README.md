# choco-task
Тестовое задание

## Установка

Для запуска проекта понадобиться composer [composer](https://getcomposer.org/)

Клонируем репозиторий

    git clone git@github.com:Mhiggster/job-task.git app

Переходим в проект и устанавливаем

    cd app/promo-service && composer dump-autoload

Настраиваем подключение к базе

    promo-service/configs/database.php
    
Если используете docker
    
    docker-compose up -d 


`localhost:8000/random-promo` // Рандомная запись

`localhost:8000/promos` // Все записи

`localhost:8000/promo/:id` // Конкретная запись

`localhost:8000/links` // Список ссылкок
