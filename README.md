`Docker build successfully tested on Linux Ubuntu 18 and Windows 11`.

1) Open `docker-compose.yml` and check is Database and Nginx ports correct for you. If already used changed it. Same for Nginx + nginx.conf.
2) Run `docker compose up -d`. This command will build containers.
3) Run `docker exec -it news_app sh`. Run `composer install`. Run `php artisan migrate --seed`.
4) Run `php artisan storage:link`, `npm install` then `npm run dev`.
