<?php

namespace Tests;

use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Verify the database connection is in-memory
        $connection = DB::connection();
        if ($connection->getDriverName() !== 'sqlite' || $connection->getDatabaseName() !== ':memory:') {
            throw new \Exception('Database is not configured for in-memory testing');
        }

        $this->seed();

        $this->installCMS();
    }

    protected function installCMS()
    {
        // create admin user

        // create roles


        // create permissions
        $user = User::first();

        // create a website
        $user->websites()->firstOrCreate(
            ['site_name' => 'Test Website'],
            ['domain' => request()->getHost()]
        );
    }
}
