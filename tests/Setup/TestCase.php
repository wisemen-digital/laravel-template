<?php

namespace Tests\Setup;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Setup\Traits\MigrateFreshSeedOnce;
use Tests\Setup\Traits\ValidateDocs;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MigrateFreshSeedOnce;
    use DatabaseTransactions;
    use ValidateDocs;
}
