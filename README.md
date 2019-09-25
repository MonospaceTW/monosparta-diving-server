# Dive In Taiwan - Server
  This is a project in a trainee program of Mono-Sparta. It's an APP about diving.
  The project is basded on **[Laravel](https://laravel.tw/) Framework 5.8.28** 

## Installation
### Windows
1. **Install [VirtualBox](https://www.virtualbox.org/)**
2. **Install [Vagrant](https://www.vagrantup.com/downloads.html)**
3. **Install [homestead](https://laravel.com/docs/5.8/homestead)**  
   All of requirements are in this virtual machine.
   
   `$ vagrant box add laravel/homestead`
   
2. **Install [Composer](https://getcomposer.org/)**  
   It's a package for PHP.
3. **Setup laravel for composer**  

   `$ composer require "laravel/homestead"`

> Make sure to place composer's system-wide vendor bin directory in your PATH so the laravel executable can be located by your system.  > This directory exists in different locations based on your operating system; however, some common locations include:
> `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin` 

5. **Start a new laravel project**  
   `$ laravel new projectName`

6. **Test**  
   http://127.0.0.1/projectName/public/

> If you still don't know how to install,please take [laravel Installation](https://laravel.com/docs/5.8/installation) as reference.

### MacOS
1. **Install PHP**  

   `$ brew install php`
2. **Install [Composer](https://getcomposer.org/)**  

3. **Install [Laravel]((https://docs.laravel-dojo.com/laravel/5.5))**

4. **Install Laravel with Composer**  

    `$ composer global require “laravel/installer”`

> Make sure to place composer's system-wide vendor bin directory in your PATH so the laravel executable can be located by your system.
> This directory exists in different locations based on your operating system; however, some common locations include:
> `$HOME/.composer/vendor/bin` 

5. **Start a new laravel project**  
   `$ laravel new projectName`
   
![](https://i.imgur.com/An8LyTL.png)


6. **Install Valet**  
   Please take [laravel Valet](https://laravel.com/docs/5.8/valet) as reference.

## Project Architecture

|NAME|PATH|DESCRIPTION|
|----|----|-----------|
|Models of Database Table |[/app](https://github.com/MonospaceTW/monosparta-diving-server/tree/master/app)|Article,Comment,Log,Shop,Spot,and User model|
|Global Controllers|[/app/Http/Controllers](https://github.com/MonospaceTW/monosparta-diving-server/tree/master/app/Http/Controllers)|Article and Comment controller. Main is in TaskController.php|
|Global Routes|[/routes/api.php](https://github.com/MonospaceTW/monosparta-diving-server/blob/master/routes/api.php)|Search,Article,and Comment routes|
|Database|[/database](https://github.com/MonospaceTW/monosparta-diving-server/tree/master/database)|migrations,seeds,factories|

## Restore Laravel Project
Because *.gitignore* will ignore some files,you must do this to restore the laravel project.  
Open your terminal,direct PATH where you want to clone at,then follow commends below.

1. **git clone**  
   `$ git clone https://github.com/MonospaceTW/monosparta-diving-server.git`

2. **Reinstall composer**  
   It will reconstruction content in   the index of vendor.  
   `$ cd monosparta-diving-server`  
   `$ composer install`
3. **Restore the index of node_modules**   
   `$ npm install`
4. **Restore *.env***  
   `$ cp .env.example .env`  
   `$ php artisan key:generate`  
   
   Open .env,then check databese,username,and password are correct.  
   For example,  
   ```
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=yourDatabaseName
   DB_USERNAME=yourUsername
   DB_PASSWORD=yourPassword
   ```
#### If you use Homestead,you need more steps.
1. **Restore Homestead.yaml**  
   `$ php vendor/bin/homestead make`
3. **Start Homestead**  
   `$ vagrant up`
5. **Sign in Homestead,and restore database**  
   `$ vagrant ssh`  
   `$ cd public_html/yourProjectName`  
   `$ php artisan migrate`
   
## API Document  
You can check API list at [API Document](https://divingapi.docs.apiary.io/#).

