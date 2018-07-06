Для разворачивания системы необходимо: 
=====================

1: Установить [Docker и Docker Compose](https://docks.docker.com/compose/install/),
а так же убедиться 
что текущей пользователь имеет права на использование docker 

2: Скопировать все файлы в свою систему в произвольную папку someDirectory

3: Выполнить комманду (клонируем файл конфига проекта)

    cp example.env .env

4: Для корректной работы копирования пользовательских файлов, 
настроить права доступа к каталогу image, например использовать в этой дирректории команду:
    
    chmod -R 777 images

5: Для работы с БД по умолчанию задан пользователь root и пароль 123, 
при необходимости или желании изменить эти значения в файлах 
docker-compose.yml и connection.php

6: Выполнить команду сборки контейнера докера:
    
    docker-compose up -d --build
    
Эта команда должна выполнять в дирректории, где находятся скопированные файлы
Если при выполении появится ошибка 
(у текущего пользователя нет прав на использование докера):

    ERROR: Couldn't connect to Docker daemon at http+docker://localunixsocket - is it running?
    If it's at a non-standard location, specify the URL with the DOCKER_HOST environment variable.
    
Использовать команду :

     sudo docker-compose up -d --build
   
7: Для загрузки БД системы выполнить следующие команды:
    
    7.1 docker-compose exec mysql bash
    7.2 cd /var/www/app
    7.3 mysql -uroot -p123 booster < blogsystem.sql
    
Данные команды позволят подключиться к контейнеру докера sql,
 и создать в нем необходмые базы данных 

8: Войти в систему используя запрос в браузер:
    
    http://localhost:6001/
