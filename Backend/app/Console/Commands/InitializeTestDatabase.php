<?php

namespace App\Console\Commands;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;

class InitializeTestDatabase extends Command
{
    //php artisan db:initdb
    //APP_ENV=testing php artisan db:initdb
    protected $signature = 'db:initdb';

    protected $description = 'Initialize the test database';

    public function handle()
    {
        //php artisan migrate --database-testing
        $this->call('migrate');
        //php artisan db:seed --class=DatabaseSeeder
        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);
    }
}
