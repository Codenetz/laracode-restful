## Overview

Laravel HMVC RESTfull API boilerplate project

The project is based on the Laravel framework and it's main purpose is for creating large, modular and complex RESTfull API more easily.

Laravel version - 6.x

- [Structure overview](#structure-overview)
- [Doctrine](#doctrine)
- [Model](#model)
- [Available endpoints](#available-endpoints)

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

Start the server and API will be working on localhost.


## Structure overview

HMVC stands for `Hierarchical model–view–controller`.
The advantage of using HMVC is code `Modularization`, `Organization` and `Reusability` 

In the `app/Modules` directory are located all modules. 
Each module has it's own MVC structure and it's dynamically 
loaded.

Every module must come with it's own configurations.
Defining `ServiceProviders`, `Routes`, `Configs`, `Commands` etc are now done inside every module 
and each of them must be placed in the appropriate folder in order to be auto loaded,
their is no need to be manually registered anymore in the application with an exception for the middleware which must 
be manually registered by some `ServiceProvider` from the specific module or in worst case scenario in `Http/Kernel.php`
(I've had some issues with defining dynamically a middleware in `routeMiddleware`)

## Doctrine

`Doctrine` is used __ONLY__ for database migrations instead the default Laravel migrations. 
For working with the database like select, insert, update etc it's used `Eloquent ORM` which is the default for
Laravel.

The reason why is choosed doctrine it's because that only a database table representation schema must be defined and doctrine
will do the rest of the work like keeping track of changes and do auto migrations.

This is a basic example of an entity (schema)
```php
<?php

namespace App\Modules\User\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Model\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="codew_user")
 */
class UserEntity extends Entity
{
    /**
     * @ORM\Column(name="username", type="string", length=250, nullable=false, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(name="password", type="string", length=250, nullable=false)
     */
    protected $password;
}
```

The entities are placed in `Entities` folder of each module.

After an entity is created the database must be synced.
This is done by running this command:

```sh
$ php artisan doctrine:schema:update
```

And that's all. The table is created with all fields.

If we need to add/remove/edit a field, it must be done inside the entity and the update command must run again.

For Doctrine integration in Laravel is used this [package](https://github.com/laravel-doctrine/orm)

## Model

Every tables in database could have a corresponding 
- [model](https://laravel.com/docs/6.x/eloquent#defining-models)
- `repository` Uses the repository pattern, it's an layer between application logic and database. This it the place
where database queries must be.
- [resource](https://laravel.com/docs/6.x/eloquent-resources)

Usage example

```php
class Users extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetch(Request $request)
    {
        $users = $this->userRepository->fetchUsers();
        return response()->json(['user' => UserResource::collection($users)], 200);
    }
}
```

## Available endpoints

Project comes with some available endpoints for example purpose.

| Method   | URI              | Action                                                             | Middleware                   |
|----------|------------------|--------------------------------------------------------------------|------------------------------|
| POST     | api/oauth/token  | Laravel\Passport\Http\Controllers\AccessTokenController@issueToken | throttle                     |
| POST     | api/product      | App\Modules\Shop\Controllers\Product@create                        | api,auth:api,role:ROLE_ADMIN |
| GET|HEAD | api/product      | App\Modules\Shop\Controllers\Product@fetchSingle                   | api                          |
| PUT      | api/product/{id} | App\Modules\Shop\Controllers\Product@edit                          | api,auth:api,role:ROLE_ADMIN |
| DELETE   | api/product/{id} | App\Modules\Shop\Controllers\Product@delete                        | api,auth:api,role:ROLE_ADMIN |
| GET|HEAD | api/products     | App\Modules\Shop\Controllers\Product@fetch                         | api                          |
| POST     | api/user/signup  | App\Modules\User\Controllers\Signup@createAccount                  | api                          |
| GET|HEAD | api/users        | App\Modules\User\Controllers\Users@fetch                           | api,auth:api,role:ROLE_ADMIN |

## License

[MIT License](https://github.com/Codenetz/laracode-restful/blob/master/LICENSE) 

@Codenetz 

Hristo Boyarov
