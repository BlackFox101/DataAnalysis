# DataAnalysis

---

## Установка:

1) Клонировать репозиторий
####`git clone https://github.com/BlackFox101/DataAnalysis.git`
2) Установить зависимости
#### `composer install`
3) Создать базу данных
#### `php bin/console doctrine:database:create`
4) Запустить миграции
#### `php bin/console doctrine:migrations:migrate`


## Получение данных Covid19
### Запустить команду и получить данных Covid19
#### `php bin/console app:get-covid19-data`
### Запустить команду и получить данных Covid19 US
#### `php bin/console app:get-covid19-us-data`