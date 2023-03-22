<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('MYSQL_DATABASE_URL'),
            'host' => env('MYSQL_DB_HOST', '127.0.0.1'),
            'port' => env('MYSQL_DB_PORT', '3307'),
            'database' => env('MYSQL_DB_NAME', 'larastack'),
            'username' => env('MYSQL_DB_USER', 'larastack_user'),
            'password' => env('MYSQL_DB_PASS', ''),
            'unix_socket' => env('MYSQL_DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('PGSQL_DATABASE_URL'),
            'host' => env('PGSQL_DB_HOST', '127.0.0.1'),
            'port' => env('PGSQL_DB_PORT', '5432'),
            'database' => env('PGSQL_DB_NAME', 'larastack'),
            'username' => env('PGSQL_DB_USER', 'larastack_user'),
            'password' => env('PGSQL_DB_PASS', 'larastack_password'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('MONGO_DB_HOST', '127.0.0.1'),
            'port' => env('MONGO_DB_PORT', 27017),
            'database' => env('MONGO_DB_NAME', 'larastack'),
            'username' => env('MONGO_DB_USER', 'larastack_mongo_user'),
            'password' => env('MONGO_DB_PASS', 'larastack_mongo_pass'),
            'options' => [
                // here you can pass more settings to the Mongo Driver Manager
                // see https://www.php.net/manual/en/mongodb-driver-manager.construct.php under "Uri Options" for a list of complete parameters that you can use

                'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
            ],
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('SQLITE_DATABASE_URL'),
            'database' => env('SQLITE_DB_PATH', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('SQLITE_DB_FOREIGN_KEYS', true),
        ],

        'phpunit_db' => [
            'driver' => 'sqlite',
            'database' => 'phpunit_database.sqlite',
            'prefix' => '',
            'foreign_key_constraints' => env('PHPUNIT_DB_FOREIGN_KEYS', true),
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('SQLSRV_DATABASE_URL'),
            'host' => env('SQLSRV_DB_HOST', 'localhost'),
            'port' => env('SQLSRV_DB_PORT', '1433'),
            'database' => env('SQLSRV_DB_DATABASE', 'larastack'),
            'username' => env('SQLSRV_DB_USERNAME', 'larastack_sqlsrv_user'),
            'password' => env('SQLSRV_DB_PASSWORD', 'larastack_sqlsrv_pass'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
