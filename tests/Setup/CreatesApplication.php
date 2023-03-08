<?php

namespace Tests\Setup;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Testing\PendingCommand;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = $this->getApp();

        $app->make(Kernel::class)->bootstrap();

        $app = $this->validateDatabaseIsSafe($app);

        $app = $this->overrideDatabaseConfig($app);

        //$this->run_artisan($app, 'migrate');

        return $app;
    }

    public function validateDatabaseIsSafe(Application $app)
    {
        $is_testing = env('APP_ENV') === 'testing';
        $correct_db = in_array(env('DB_HOST'), ['127.0.0.1', 'mysql']);
        $db_url_empty = strlen(''.env('DATABASE_URL')) == 0;

        $url = $app['config']['database.connections.mysql.url'];
        $host = $app['config']['database.connections.mysql.host'];

        $envWrong = ! $is_testing || ! $correct_db || ! $db_url_empty;
        $configWrong = strlen($url) != 0 || ! in_array($host, ['127.0.0.1', 'mysql']);

        if ($envWrong || $configWrong) {
            throw new \Exception('A database security measure failed. Current config might be dangerous:'.print_r([
                'is_testing' => $is_testing,
                'correct_db' => $correct_db,
                'db_url_empty' => $db_url_empty,
            ], true));
        }

        return $app;
    }

    public function overrideDatabaseConfig(Application $app)
    {
        $app['config']['database.connections.mysql.url'] = '';

        if (isset($_ENV['DB_HOST'])) {
            $app['config']['database.connections.mysql.host'] = $_ENV['DB_HOST'];
        }
        if (isset($_ENV['DB_PORT'])) {
            $app['config']['database.connections.mysql.port'] = $_ENV['DB_PORT'];
        }

        return $app;
    }

    public function getApp()
    {
        $app = new \Illuminate\Foundation\Application(
            realpath(__DIR__.'/../../')
        );

        $app->singleton(
            \Illuminate\Contracts\Http\Kernel::class,
            \App\Http\Kernel::class
        );

        $app->singleton(
            \Illuminate\Contracts\Console\Kernel::class,
            \App\Console\Kernel::class
        );

        $app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \App\Exceptions\Handler::class
        );

        return $app;
    }

    public function run_artisan($app, $command, $parameters = [])
    {
        if (! $this->mockConsoleOutput) {
            return $app[Kernel::class]->call($command, $parameters);
        }

        return new PendingCommand($this, $app, $command, $parameters);
    }
}
