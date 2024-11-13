<?php

namespace Tests\Setup\Traits;

use Illuminate\Support\Facades\Artisan;

trait MigrateFreshSeedOnce
{
    /**
     * If true, setup has run at least once.
     *
     * @var bool
     */
    protected static $setUpHasRunOnce = false;

    /**
     * After the first run of setUp "migrate:fresh --seed"
     */
    protected function setUp(): void
    {
        parent::setUp();
        if (! static::$setUpHasRunOnce) {
            Artisan::call('migrate:fresh');
            Artisan::call(
                'db:seed',
                ['--class' => 'DatabaseSeeder']
            );
            static::$setUpHasRunOnce = true;
        }
    }
}
