<?php
namespace Tests\Feature\Connections;

use Illuminate\Support\Facades\DB;

it('can connect to, insert/fetch, and delete from/to mongodb', function () {
	// start here : https://pestphp.com/docs/writing-tests
	//$this->assertTrue(true);
	//expect(true)->toBeTrue();
	//$mongo = DB\connect('mongodb');
	// read "MONGO_DB_HOST" value from .env file
	$MONGO_DB_HOST = config('database.connections.mongodb.host');
	if (empty($MONGO_DB_HOST)) {
		return $this->markTestSkipped('MongoDB is Not Enabled or MONGO_DB_HOST is not valid!');
	}
	$mongoDB = DB::connection('mongodb')->getMongoDB();
	$insertResult = $mongoDB->selectCollection('test_collection')->insertOne(['foo' => 'bar']);
	$response = [
		'mongoInsertedId' => $insertResult->getInsertedId()->__toString(),
	];
	$mongoDB->selectCollection('test_collection')->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($response['mongoInsertedId'])]);
	$mongoDB->dropCollection('test_collection');
	$this->assertTrue(true);
});

it('can connect to, insert/fetch, and delete from/to PGSQL', function () {
	// start here : https://pestphp.com/docs/writing-tests
	//$pgsql = DB::connection('pgsql');
	// read "PGSQL_DB_HOST" value from .env file
	$PGSQL_DB_HOST = config('database.connections.pgsql.host');
	if (empty($PGSQL_DB_HOST)) {
		return $this->markTestSkipped('PostgreSQL is Not Enabled or PGSQL_DB_HOST is not valid!');
	}
	$pgsqlDB = DB::connection('pgsql')->getPdo();
	$pgsqlDB->query('CREATE TABLE IF NOT EXISTS test_table (id SERIAL PRIMARY KEY, test_field VARCHAR(255))');
	$insertResult = $pgsqlDB->query('INSERT INTO test_table (test_field) VALUES (\'foo\')');
	$response = [
		'pgsqlInsertedId' => $pgsqlDB->lastInsertId(),
	];
	$pgsqlDB->query('DELETE FROM test_table WHERE id = '.$response['pgsqlInsertedId']);
	$pgsqlDB->query('DROP TABLE test_table');
	$this->assertTrue(true);
});

it('can connect to, insert/fetch, and delete from/to Redis',function (){
	$REDIS_HOST = config('database.redis.default.host');
	if(empty($REDIS_HOST)) {
		return $this->markTestSkipped('Redis is Not Configured!');
	}
	$redis = \Illuminate\Support\Facades\Redis::connection('default');
	$redis->SET('foo','bar');
	$result = $redis->GET('foo');

	if($result === 'bar'){
		// delete the key
		$redis->del('foo');
		$this->assertTrue(true);
	}
});
