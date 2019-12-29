## Overview

Laravel HMVC RESTfull API boilerplate project

Modular architecture created for building big and complex RESTfull APIs more easily.

...

## Installation

_It is not included composer installation and configuration of web server and database._

Create the environment configurations

```sh
$ cp .env.example .env
```

Install dependencies
```sh
$ composer install
```

Generate application key
```sh
$ php artisan key:generate && php artisan config:clear
```

Run migrations, basically it is only for the oauth tables.

Laravel migrations are replaced with [Doctrine2](https://www.doctrine-project.org/) schema sync.
```sh
$ php artisan migrate
```

Create need it tables by synchronizing [Doctrine2](https://www.doctrine-project.org/) schemas.

For managing database tables must be used [Doctrine2](https://www.doctrine-project.org/) instead default Laravel migrations which
are hard to maintain when the project gets bigger.
```sh
$ php artisan doctrine:schema:update
```

Install passport. 

Reference to [Passport documentation](https://laravel.com/docs/6.x/passport)
```sh
$ php artisan passport:install
```

Clear application cache
```sh
$ php artisan cache:clear && php artisan config:clear && php artisan config:cache
```

Set appropriate permissions on `storage` and `bootstrap/cache` like said in official [documentation](https://laravel.com/docs/6.x#installing-laravel).

## Module

...

## License

...
