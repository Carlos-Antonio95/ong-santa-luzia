<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Administrador padrão
    |--------------------------------------------------------------------------
    |
    | Dados usados pelo AdminSeeder para criar o primeiro usuário. Os valores
    | vêm do .env; passam por aqui para continuar disponíveis com config:cache.
    |
    */

    'name' => env('ADMIN_NAME'),
    'email' => env('ADMIN_EMAIL'),
    'password' => env('ADMIN_PASSWORD'),

];
