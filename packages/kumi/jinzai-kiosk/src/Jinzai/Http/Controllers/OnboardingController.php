<?php

namespace Kumi\Jinzai\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Kumi\Jinzai\Models\OnboardingLink;
use Illuminate\Support\Facades\Redirect;
use Kumi\Jinzai\Actions\CompleteEmployeeOnboarding;

class OnboardingController extends Controller
{
    public function edit(OnboardingLink $link)
    {
        $employee = $link->employee;

        abort_if($link->isExpired(), Response::HTTP_NOT_FOUND);
        abort_if($employee->hasBeenThroughOnboarding(), Response::HTTP_NOT_FOUND);

        return view('jinzai::onboarding.edit', [
            'link' => $link,
        ]);
    }

    public function update(OnboardingLink $link, Request $request)
    {
        $employee = $link->employee;
        $user = $employee->user;

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::exists('users')
                    ->where('id', $user->id),
            ],
            'password' => [
                'required',
                'string',
                new Password(),
                'confirmed',
            ],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $employee->disableLogging();
        $employee->update([
            'onboarded_at' => Carbon::now(),
        ]);

        CompleteEmployeeOnboarding::run($user, $employee, $validated);

        return Redirect::to(Filament::getUrl());
    }
}
