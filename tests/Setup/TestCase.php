<?php

namespace Tests\Setup;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use DatabaseMigrations;
    //use RefreshDatabase;
    use DatabaseTransactions;
    use DatabaseMigrations;
    use ValidateDocs;

    //RefreshDatabase: Define hooks to migrate the database before and after each test.
    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            var_dump('running migrate');
            $this->artisan('migrate');

            $this->app[Kernel::class]->setArtisan(null);

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }

    //DatabaseMigrations
    public function runDatabaseMigrations()
    {
        $this->artisan('migrate');

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            RefreshDatabaseState::$migrated = false;
        });
    }
}
