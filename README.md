# Windwalker Starter

This is [Windwlaker Framework](https://github.com/ventoviro/windwalker) starter package.

## Installation Via Composer

``` bash
$ php composer.phar create-project windwalker/starter windwalker ~2.0 -s beta
```

## Getting Started

Copy `etc/config.dist.yml` to `etc/config.yml` and fill database information.

Open `http://{Your project root}/www`, you will see sample page.

## Using Console

Type this command in your terminal:

``` bash
php bin/console
```

You will see console usage:

```
Windwalker Console - version: 2.0
------------------------------------------------------------

[console Help]

The default application command

Usage:
  console <command> [option]


Options:

  -h | --help       Display this help message.
  -q | --quiet      Do not output any message.
  -v | --verbose    Increase the verbosity of messages.
  --no-ansi         Suppress ANSI colors on unsupported terminals.
                    Use --no-ansi=false to force using color.

Available commands:

  help     List all arguments and show usage & manual.

  build    Some useful tools for building system.

  phinx    Migration system by Phinx
```

### Import Sample Schema

``` bash
php bin/console phinx migrate
```

## How To Use Windwalker

Please see README in every [Windwalker packages](https://github.com/ventoviro) first.
