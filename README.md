# LYRASOFT Earth

![151214-0001](https://cloud.githubusercontent.com/assets/1639206/14016277/15bb757c-f1fa-11e5-8b9c-821cb53d6f2a.jpg)

![p-2016-07-03-001](https://cloud.githubusercontent.com/assets/1639206/16545958/858490b6-416c-11e6-9981-03c6d1dce102.jpg)

## Installation Via Composer

``` bash
$ php composer.phar create-project lyrasoft/earth your_project ~1.1
```

## Getting Started

Open `http://{Your project root}/www/admin`, you will see the sample page.

Open `http://{Your project root}/www/dev.php`, you will enter the development mode.

## Use Database

Copy `etc/secret.dist.yml` to `etc/secret.yml` and fill database information.

## Using Console

Type this command in your terminal:

``` bash
php windwalker
```

You will see console usage:

```
Windwalker Console - version: 3.0
------------------------------------------------------------

[console Help]

The default application command

Usage:
  console <command> [option]


Options:

  -h | --help       Display this help message.
  -q | --quiet      Do not output any message.
  -v | --verbose    Increase the verbosity of messages.
  --ansi            Set 'off' to suppress ANSI colors on unsupported terminals.

Commands:

  muse         The template generator.
  phoenix      The Phoenix RAD package.
  asset        Asset management
  migration    Database migration system.
  seed         The data seeder help you create fake data.
  package      Package operations.

Welcome to Windwalker Console.
```

### Import Sample Schema

``` bash
php windwalker migration status
php windwalker migration migrate --seed
```

## How To Use Windwalker

Please see README in every [Windwalker packages](https://github.com/ventoviro) first.