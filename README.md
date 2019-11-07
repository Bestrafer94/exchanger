Technology stack:
- PHP 7.3
- Symfony 4.3.6
- MySQL 8.0.18
- Redis 5.0.3
- Docker

LOCAL SETUP:
- adjust parameters to your needs in `.env.dist` file or start with default configuration
- `cp .env.dist .env`
- `docker compose up -d --build`
- `docker exec -it bonuses_php_1 bash`
- `composer install`
- `./bin/console doctrine:schema:update --force`

LOGIN TO ADMINER:
- server: `mysql`
- user: `root`
- password: `${MYSQL_ROOT_PASSWORD}`
- database: `${MYSQL_DATABASE_NAME}`

