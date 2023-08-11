<?php

namespace Kumi\Kyoka\Console\Commands;

use Illuminate\Support\Str;
use Kumi\Tobira\Models\User;
use Illuminate\Console\Command;
use Kumi\Kyoka\Support\SystemUser;
use Illuminate\Support\Facades\Hash;
use Kumi\Kyoka\Support\DefaultRoles;

/**
 * @codeCoverageIgnore
 */
class InitSystemUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kyoka:init-system-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize a user with [System] role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::firstOrCreate(
            [
                'name' => SystemUser::NAME,
                'email' => SystemUser::EMAIL,
            ],
            [
                'password' => Hash::make(Str::random(100)),
            ]
        );

        $user->assignRole(DefaultRoles::SYSTEM);

        $this->info('Success! User `System` has been initialized.');

        return static::SUCCESS;
    }
}
