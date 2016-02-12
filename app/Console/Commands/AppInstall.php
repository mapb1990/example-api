<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class AppInstall
 *
 * @package App\Console\Commands
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install application';

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
        $this->info('Installing application...');

        try {
            // App migrations
            $this->call('migrate:install');
        } catch (\PDOException $e) {
            $this->error('Application is already install.');
            $this->warn('Use "php artisan app:refresh" instead".');
            return;
        }

        $this->comment('Creating database tables...');
        $this->call('migrate');

        // Flush cache
        $this->comment('Flush cache...');
        $this->call('cache:clear');

        $this->call('app:seed');

        $this->info('Application install successively.');
    }
}
