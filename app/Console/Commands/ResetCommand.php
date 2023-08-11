<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset application state';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('kyoka:bootstrap');
        $this->call('kyoka:init-system-user');
        $this->call('kiosk:init-ticket-categories');
        $this->call('db:seed');
        $this->call('cache:clear');

        File::deleteDirectories(storage_path('app/public'));

        return 0;
    }
}
