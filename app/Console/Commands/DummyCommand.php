<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DummyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dummy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dummy';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return static::SUCCESS;
    }
}
