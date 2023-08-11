<?php

namespace Kumi\Tobira\Http\Controllers\Fortify;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Laravel\Fortify\Http\Controllers\NewPasswordController as BaseNewPasswordController;

class NewPasswordController extends BaseNewPasswordController
{
    /**
     * Show the new password view.
     */
    public function edit(Request $request): ResetPasswordViewResponse
    {
        return $this->create($request);
    }

    /**
     * Reset the user's password.
     */
    public function update(Request $request): Responsable
    {
        return $this->store($request);
    }
}
