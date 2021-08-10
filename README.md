# LYRASOFT Earth 2.0

## Installation Via Composer

``` bash
composer create-project lyrasoft/earth your_project
```

## Prepare System

Type this command in your terminal to deploy system and run migration for production environment: 

``` bash
php windwalker run prepare
```

If you want to set prepare to dev mode, you can use this command in your terminal to run assets sync, migrations and seeders: 

``` bash
php windwalker run preparedev
```

## Getting Started

Open `http://{Your project root}/www/admin`, you will see the sample page.

Open `http://{Your project root}/www/dev.php`, you will enter the development mode.

