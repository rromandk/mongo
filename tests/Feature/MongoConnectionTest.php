<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MongoConnectionTest extends TestCase
{
    public function test_mongodb_connection_works()
    {
        $connection = DB::connection('mongodb');

        $this->assertNotNull($connection);

        // intenta listar colecciones
        $collections = $connection->getMongoDB()->listCollections();

        $this->assertNotEmpty(iterator_to_array($collections));
    }
}
