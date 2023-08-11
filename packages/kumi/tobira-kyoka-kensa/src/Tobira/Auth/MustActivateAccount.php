<?php

namespace Kumi\Tobira\Auth;

trait MustActivateAccount
{
    /**
     * Determine if the user has been activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        return ! is_null($this->activated_at);
    }

    /**
     * Determine if the user has been activated.
     *
     * @return bool
     */
    public function isDeactivated()
    {
        return is_null($this->activated_at);
    }

    /**
     * Mark the given user as active.
     *
     * @return bool
     */
    public function markUserAsActive()
    {
        return $this->forceFill([
            'activated_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Mark the given user as inactive.
     *
     * @return bool
     */
    public function markUserAsInactive()
    {
        return $this->forceFill([
            'activated_at' => null,
        ])->save();
    }
}
