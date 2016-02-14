<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class AppSeed
 *
 * @package App\Console\Commands
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class AppSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // App seed
        $this->comment('Seeding database...');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $this->call('db:seed');

        if ($this->confirm('Seed application with test data?', \Config::get('app.debug'))) {
            $this->comment('Populating with dummy data...');
            $this->call('db:seed', ['--class' => 'DummyDataSeeder']);
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
