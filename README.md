<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Installed Laravel env:
`$ sudo update-alternatives --config php` -> (per selezionare versione di php da utilizzare) <br>
`$ php -v`  -> PHP 8.1.2-1ubuntu2.10 (cli) (built: Jan 16 2023 15:19:49)   <br>
`$ composer create-project laravel/laravel scanner-crm`  -> laravel/laravel (v10.2.6)  <br>

## run with (dev):
`cd scanner-crm` & `php artisan serve`

## history
- configure your `.env`
- `npm install` & `npm run dev`
- rimossi riferimenti a `User` starter template
- creato `app.blade` per template 
- `php artisan make:model -mrc Scansioni` 
- aggiunto `index.scansioniblade`
- `php artisan migrate` per tabella `scansionis`