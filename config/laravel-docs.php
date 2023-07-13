<?php

use AppwiseLabs\LaravelDocs\Http\Middleware\CanViewDocs;

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel Docs - Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the OpenAPI documentation will be accessible from. Feel free
    | to change this path to anything you like.
    |
    */

    'path' => 'docs',

    'middleware' => [
        'web',
        CanViewDocs::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Docs - OpenAPI File
    |--------------------------------------------------------------------------
    |
    | This is the location of the project's OpenAPI YAML/JSON file. It's
    | this file that will be used in OpenAPI UI. This can either be a local
    | file or an url to a file.
    |
    */

    'file' => resource_path('docs/openapi.yaml'),
];
