<?php
/**
 * Created by PhpStorm.
 * User: llaijiale
 * Date: 2017/8/2
 * Time: 10:21
 */

return [
    'informix' => [
        'driver'    => 'informix',
        'host'      => env('DB_HOST', '192.168.13.222'),
        'database'  => env('DB_DATABASE', 'tbase7'),
        'username'  => env('DB_USERNAME', 'hsuarez'),
        'password'  => env('DB_PASSWORD', 'Hsuar32123'),
        'service'  => env('DB_SERVICE', ''),
        'server'  => env('DB_SERVER', 'desa'),
        'db_locale'   => 'en_US.819',
        'client_locale' => 'en_US.819',
        'db_encoding'   => 'GBK',
        'initSqls' => false,
        'client_encoding' => 'UTF-8',
        'prefix'    => ''
    ],

    'informix-source-json' => [
        'driver'    => 'informix-json',
        'uri'      => 'http://XX.X.XX.XX:9999/json',
        'source'  => 'source',
        'token'  => 'SDL3490FI2902309DSFK203SDKL2334202',
    ],
];