<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

/**
 * Class AppRefresh
 *
 * @package App\Console\Commands
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class AppRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the application installation';

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
        if ($this->confirm(
            'Are you sure you want to refresh your installation? You will loose all data stored in the database!',
            \Config::get('app.debug')
        )) {
            // First reset data
            $this->info('Uninstalling application...');
            \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            $this->call('migrate:reset');
            \Schema::drop(\Config::get('database.migrations'));
            $this->info('Application uninstall successively.');

            // Now install it again
            $this->call('app:install');
            \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        }
    }
}
