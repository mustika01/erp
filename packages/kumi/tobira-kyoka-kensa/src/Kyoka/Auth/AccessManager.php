<?php

namespace Kumi\Kyoka\Auth;

use Illuminate\Support\Collection;

class AccessManager
{
    protected Collection $permissions;
    protected Collection $roles;
    protected Collection $access;

    public function __construct(Collection $permissions, Collection $roles, Collection $access)
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
        $this->access = $access;
    }

    public function registerPermissions(array $permissions): void
    {
        $this->permissions = $this->permissions->merge($permissions);
    }

    public function registerRoles(array $roles): void
    {
        $this->roles = $this->roles->merge($roles);
    }

    public function registerAccess(array $access): void
    {
        foreach ($access as $role => $permissions) {
            if (! $this->access->has($role)) {
                $this->access->put($role, new Collection());
            }

            $collection = $this->access->get($role);

            foreach ($permissions as $permission) {
                if (! $collection->contains($permission)) {
                    $collection->push($permission);
                }
            }

            $this->access->put($role, $collection);
        }
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function getAccess(): Collection
    {
        return $this->access;
    }
}
