<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        
        'documentos' =>[
            'driver' => 'local',
            'root' => public_path('documentos'),
            'url' => env('APP_URL').'/documentos',
            'visibility' => 'public',
        ],
        'manifestos_anexo' =>[
            'driver' => 'local',
            'root' => public_path('manifestos_anexo'),
            'url' => env('APP_URL').'/manifestos_anexo',
            'visibility' => 'public',
        ],
        'contratos' =>[
            'driver' => 'local',
            'root' => public_path('contratos'),
            'url' => env('APP_URL').'/contratos',
            'visibility' => 'public',
        ],
        
        'relatorios' =>[
            'driver' => 'local',
            'root' => public_path('relatorios'),
            'url' => env('APP_URL').'/relatorios',
            'visibility' => 'public',
        ],
               
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
