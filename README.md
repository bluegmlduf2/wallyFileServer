## Feature
- [laravel/laravel 9.52.4](https://github.com/laravel/laravel)
- [Laravel/breeze](https://github.com/laravel/breeze)
- [Laravel/lang](https://github.com/Laravel-Lang/lang/tree/3c0258d844acab266a2ffb1a2b89a20f2708a58e)
- [PHP 8.0.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)

## Installation
```bash
composer create-project laravel/laravel wallyFileServer
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
php artisan serve
```
## recommend
```bash
php artisan storage:link
```

## vscode debug
### install tool
- xDebug 3.2.0
- vscode extension PHP Debug

```bash
pecl install xdebug
```
add this line to php.ini
```bash
   zend_extension=xdebug.so
   xdebug.mode=develop,debug
   xdebug.start_with_request=yes
```
make launch.json in vscode and run "Listen for Xdebug"