версия php 8.0
версия MySql 5.7

Для работы необходимо включить расширения yaml, pdo_mysql в PHP.ini

**Установка:**
+ Создать папку, из неё последовательно запустить команды:
```
git pull https://github.com/TomLepsky/persona_test
composer install
php -S localhost:8888 -t src src/index.php
```
+ Cоздать базу данных MySql
Дамп базы в файле
```
testdb.sql
```
+ Настроить подключение к MySql
Конфигурация базы данных в файле
```
db_config.yaml
```


Документация [Postman](https://documenter.getpostman.com/view/15362097/2s8YzS13sh)