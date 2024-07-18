<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Líneas de Lenguaje para Paginación
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas de lenguaje son utilizadas por la biblioteca del
    | paginador para construir los enlaces de paginación simples. Eres libre de
    | cambiarlas a lo que quieras para personalizar tus vistas y que se ajusten
    | mejor a tu aplicación.
    |
    */



    # Número de usuarios a mostrar en los listados
    'users' => env('USERS_PER_PAGE', 8),

    # Número de usuarios a mostrar en los listados
    'bikes' => env('BIKES_PER_PAGE', 8)

];
