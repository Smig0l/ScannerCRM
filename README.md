<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## run with (dev):
`cd scanner-crm` & `php artisan serve`

## history
- `composer create-project laravel/laravel scanner-crm`  -> laravel/laravel (v10.2.6)
- configure your `.env`
- `npm install` & `npm run dev`
- rimossi riferimenti a `User` starter template
- creato `app.blade` per template 
- `php artisan make:model -mrc Scansioni` 
- `php artisan migrate` per tabella `scansionis`

## Prod / first setup
- `cat /etc/os-release` > NAME="Rocky Linux" VERSION="9.1"
- `dnf -y install epel-release / htop / net-tools / vim / git / php / mysql / mysql-server / nginx / composer`
- `systemctl start mysqld / nginx`
- `mysql_secure_installation`:
    DB_USER = root
    DB_PASSWORD = root
- since it requires php >= 8.1: <br>
    `dnf install https://rpms.remirepo.net/enterprise/remi-release-9.rpm` <br>
    `dnf update` <br>
    `dnf module list php` <br>
    `dnf module enable php:remi-8.1` <br>
    `dnf update` <br>
    `php -v` (to check php version) <br>
    `dnf install php-mysql` <br>
- `git clone "https://github.com/Smig0l/ScannerCRM.git"`
- `cd ScannerCRM`
- `composer install` 
- `vim .env` (copiare da env.sample e settare APP_ENV=production insieme ai parametri per il DB)
- `mysql -u root -p` > `create database DB_NAME;` (scannercrm)
- `php artisan migrate` (per creare automaticamente la tabella scansionis)
- `mv ScannerCRM /usr/share/nginx/`
- `chown -R nginx:nginx /usr/share/nginx/ScannerCRM/storage` //FIXME: env?
- `chown -R nginx:nginx /usr/share/nginx/ScannerCRM/public`
- `vim /etc/php-fpm.d/www.conf` > user / group = nginx
- `systemctl restart php-fpm`
- `mkdir /etc/nginx/ssl`
- `sudo openssl req -x509 -nodes -newkey rsa:4096 -keyout /etc/nginx/ssl/nginx.key -out /etc/nginx/ssl/nginx.crt -days 365`
- `vim /etc/nginx/conf.d/scansionicrm.conf` (for the virtualhost block):
    >   
        server {
        listen 80;
        listen [::]:80;
        server_name example.com; 
        return 301 https://$host$request_uri;
        }

        server {
            listen 443 ssl;
            listen [::]:443 ssl;
            server_name example.com;
            root /usr/share/nginx/ScannerCRM/public;

            ssl_certificate /etc/nginx/ssl/nginx.crt;
            ssl_certificate_key /etc/nginx/ssl/nginx.key;

            add_header X-Frame-Options "SAMEORIGIN";
            add_header X-Content-Type-Options "nosniff";

            index index.php;

            charset utf-8;

            location / {
                try_files $uri $uri/ /index.php?$query_string;
            }

            location = /favicon.ico { access_log off; log_not_found off; }
            location = /robots.txt  { access_log off; log_not_found off; }

            error_page 404 /index.php;

            location ~ \.php$ {
                fastcgi_pass unix:/run/php-fpm/www.sock;
                fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                include fastcgi_params;
            }

            location ~ /\.(?!well-known).* {
                deny all;
            }
        }




