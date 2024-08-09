## После засеивания таблицы данными с использованием сидера, тестовый аккаунт для доступа к списку заказов
Логин: test@test.ru
Пароль: 111

## Для запуска в docker-е

Переименовать .env.example в .env

Зайти в контейтнер приложения:
docker exec -it project_app bash

Запустить миграции:
php artisan migrate --seed

docker-compose up -d
