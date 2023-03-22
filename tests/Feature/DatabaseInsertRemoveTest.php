<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;

it('can connect ,insert and delete from/to mongodb', function () {
    // start here : https://pestphp.com/docs/writing-tests
    //$this->assertTrue(true);
    //expect(true)->toBeTrue();
    //$mongo = DB\connect('mongodb');
    // read "MONGO_DB_HOST" value from .env file
    $MONGO_DB_HOST = config('database.connections.mongodb.host');
    if ($MONGO_DB_HOST !== 'mongo') {
        return $this->markTestSkipped('MongoDB is Not Enabled or MONGO_DB_HOST is not valid!');
    }
    $mongoDB = DB::connection('mongodb')->getMongoDB();
    $insertResult = $mongoDB->selectCollection('user')->insertOne(['foo' => 'bar']);
    $response = [
        'mongoInsertedId' => $insertResult->getInsertedId()->__toString(),
    ];
    $mongoDB->selectCollection('user')->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($response['mongoInsertedId'])]);
    $this->assertTrue(true);
});

it('can connect ,insert and delete from/to PGSQL', function () {
    // start here : https://pestphp.com/docs/writing-tests
    //$pgsql = DB::connection('pgsql');
    // read "PGSQL_DB_HOST" value from .env file
    $PGSQL_DB_HOST = config('database.connections.pgsql.host');
    if ($PGSQL_DB_HOST !== 'pgsql') {
        return $this->markTestSkipped('PostgreSQL is Not Enabled or PGSQL_DB_HOST is not valid!');
    }
    $pgsqlDB = DB::connection('pgsql')->getPdo();
    $insertResult = $pgsqlDB->query('INSERT INTO user (name) VALUES (\'bar\')');
    $response = [
        'pgsqlInsertedId' => $pgsqlDB->lastInsertId(),
    ];
    $pgsqlDB->query('DELETE FROM user WHERE id = '.$response['pgsqlInsertedId']);
    $this->assertTrue(true);
});
