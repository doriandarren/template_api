### Proyecto API Restful

Proyecto laravel. Contempla lo siguiente:
- Laravel Framework 9.7.0
- PHP 8.1.0

## Para Backend / API:

Para el desarrollo se utiliza Sanctum para conexiones API.


## Documentación

- **[Postman](https://documenter.getpostman.com/view/5599797/UVz1MXb9)**


## Instalación y migrationes

- Usar el .env.example para crear un .env (copiar y pegar)

```sh
composer install
```

```sh
php artisan key:generate
```

```sh
php artisan migrate --seed
```





## Controller

```

php artisan make:controller Auth/AuthRegisterController &&
php artisan make:controller Auth/AuthLoginController &&
php artisan make:controller Auth/AuthLogoutController &&
php artisan make:controller Auth/AuthUserController &&
php artisan make:controller Auth/PasswordResets/ForgotPasswordController &&
php artisan make:controller Auth/PasswordResets/RestorePasswordController


php artisan make:controller Users/UserListController &&
php artisan make:controller Users/UserListPaginateController &&
php artisan make:controller Users/UserShowController &&
php artisan make:controller Users/UserStoreController &&
php artisan make:controller Users/UserUpdateController &&
php artisan make:controller Users/UserDestroyController


php artisan make:controller Abilities/AbilityListController &&
php artisan make:controller Abilities/AbilityListPaginateController &&
php artisan make:controller Abilities/AbilityShowController &&
php artisan make:controller Abilities/AbilityStoreController &&
php artisan make:controller Abilities/AbilityUpdateController &&
php artisan make:controller Abilities/AbilityDestroyController



php artisan make:controller Roles/RoleListController &&
php artisan make:controller Roles/RoleListPaginateController &&
php artisan make:controller Roles/RoleShowController &&
php artisan make:controller Roles/RoleStoreController &&
php artisan make:controller Roles/RoleUpdateController &&
php artisan make:controller Roles/RoleDestroyController





php artisan make:controller Role_users/Role_userListController &&
php artisan make:controller Role_users/Role_userListPaginateController &&
php artisan make:controller Role_users/Role_userShowController &&
php artisan make:controller Role_users/Role_userStoreController &&
php artisan make:controller Role_users/Role_userUpdateController &&
php artisan make:controller Role_users/Role_userDestroyController &&



php artisan make:controller AbilityUsers/AbilityUserListController &&
php artisan make:controller AbilityUsers/AbilityUserListPaginateController &&
php artisan make:controller AbilityUsers/AbilityUserShowController &&
php artisan make:controller AbilityUsers/AbilityUserStoreController &&
php artisan make:controller AbilityUsers/AbilityUserUpdateController &&
php artisan make:controller AbilityUsers/AbilityUserDestroyController


```


## Models

```

php artisan make:model UserStatuses/UserStatus -f
php artisan make:model Roles/Role -f
php artisan make:model Abilities/Ability -f
php artisan make:model Auth/PasswordResets/PasswordReset
php artisan make:model Role_users/Role_user -mf
php artisan make:model AbilityUsers/AbilityUser -f

```




## Sedder

```

php artisan make:seeder UserRolesAbilitiesSeeder


```



## Migrations

```

php artisan migrate --seed

```




## Proceso de Autenticaticacion y obtención de Token:

1) Registrarse en el proyecto: url > 'http://poyecto_local/api/auth/register'
   Paso Opcional por que Existe un usuario por defecto usuario: webmaster@globaltank.eu

2) Login: url > 'http://poyecto_local/api/auth/login'
   Credenciales de acceso del usuario por defecto: webmaster@globaltank.eu / pass: Global2022
   y se obtiene un token de acceso: "access_token"

4) Encuentra el User: url > 'http://poyecto_local/api/auth/user'
   Encuentra el token en la respuesta de la petición:
   Solicitud:
    - solicitud.headers.Authorization = 'Bearer ' + token
      Respuesta:
    - respuesta.data > datos del User
    - respuesta.data > otros datos del usuario
