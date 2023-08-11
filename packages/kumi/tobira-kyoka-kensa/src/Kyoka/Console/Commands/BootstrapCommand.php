<?php

namespace Kumi\Kyoka\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Kumi\Kyoka\Models\Permission;
use Kumi\Kyoka\Models\Role;
use Kumi\Kyoka\Support\Facades\Access;

/**
 * @codeCoverageIgnore
 */
class BootstrapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kyoka:bootstrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap registered roles and permissions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Access::getPermissions()->each(function ($permission) {
            $instance = Permission::firstOrCreate([
                'name' => $permission['name'],
                'label' => $permission['label'],
                'description' => $permission['description'],
                'group' => $permission['group'],
                'namespace' => $permission['namespace'],
            ]);

            if ($instance->wasRecentlyCreated) {
                $this->info("Registered permission: {$permission['label']}");
            } else {
                $this->info("Detected permission: {$permission['label']}");
            }
        });

        Access::getRoles()->each(function ($role) {
            $instance = Role::query()
                ->withoutGlobalScopes()
                ->firstOrCreate([
                    'name' => $role['name'],
                    'label' => $role['label'],
                    'description' => $role['description'],
                    'is_editable' => false,
                ])
            ;

            if (isset($role['permissions'])) {
                $instance->syncPermissions($role['permissions']);
            }

            if ($instance->wasRecentlyCreated) {
                $this->info("Registered role: {$role['label']}");
            } else {
                $this->info("Detected role: {$role['label']}");
            }
        });

        Access::getAccess()->each(function (Collection $permissions, $role) {
            $instance = Role::query()
                ->withoutGlobalScopes()
                ->where('name', $role)
                ->first()
            ;

            $instance->syncPermissions($permissions);
        });

        return 0;
    }
}
