#!/bin/bash

cp .env.example .env && sed -i -r 's/^(DB_HOST=).*/\1mdb_micasino/' ".env" && sed -i -r 's/^(DB_DATABASE=).*/\1${MYSQL_DATABASE}/' ".env" && sed -i -r 's/^(DB_PASSWORD=).*/\1${MYSQL_ROOT_PASSWORD}/' ".env" && sed -i -r 's/^(MAIL_HOST=).*/\1mh_micasino/' ".env" && composer install && php artisan key:generate && php artisan migrate --seed && php artisan storage:link && printf "swoole\n" | php artisan octane:install && npm install && npm run build

mkdir -p /etc/supervisor/conf.d/

config_content="[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/artisan queue:work --sleep=3 --tries=0 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=nginx
numprocs=8
redirect_stderr=true
stdout_logfile=/home/www-data/worker.log
stopwaitsecs=3600"

echo "$config_content" >> /etc/supervisor/conf.d/queues.conf

config_content="[program:laravel-octane-worker]
process_name=%(program_name)s_%(process_num)02d
#command=php /var/www/html/artisan octane:start --server=swoole --port=8000 --watch
command=php /var/www/html/artisan octane:start --server=swoole --port=8000
autostart=true
autorestart=true
user=nginx
redirect_stderr=true
stdout_logfile=/var/www/html/storage/logs/laravel-octane-worker.log​
stopwaitsecs=3600"

echo "$config_content" >> /etc/supervisor/conf.d/octane.conf

echo "8.8.8.8" >> /etc/resolv.conf

/bin/bash /start.sh