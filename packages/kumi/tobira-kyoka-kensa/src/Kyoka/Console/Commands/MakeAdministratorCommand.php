<?php

namespace Kumi\Kyoka\Console\Commands;

use Kumi\Kyoka\Support\DefaultRoles;
use Filament\Commands\MakeUserCommand;

/**
 * @codeCoverageIgnore
 */
class MakeAdministratorCommand extends MakeUserCommand
{
    protected $description = 'Creates a user with [Super Administrator] role.';

    protected $signature = 'kyoka:make-administrator';

    public function handle(): int
    {
        $user = $this->createUser();
        $user->markEmailAsVerified();
        $user->assignRole(DefaultRoles::ADMINISTRATOR);
        $user->assignRole(DefaultRoles::FILAMENT_USER);

        $loginUrl = route('filament.auth.login');

        $this->info('Success! ' . ($user->getAttribute('email') ?? $user->getAttribute('username') ?? 'You') . " may now log in at {$loginUrl}.");

        return static::SUCCESS;
    }
}
