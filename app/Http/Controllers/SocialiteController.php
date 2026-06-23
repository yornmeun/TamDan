<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        $this->validateProvider($provider);
 
        return Socialite::driver($provider)->redirect();
    }
 
    public function callback(string $provider)
    {
        $this->validateProvider($provider);
        try {
            $response = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'login' => 'Google login failed. Please try again.',
            ]);
        }

        $user = User::firstWhere(['email' => $response->getEmail()]);
 
        if ($user) {
            $user->update([$provider . '_id' => $response->getId()]);
        } else {
            $user = User::create([
                $provider . '_id' => $response->getId(),
                'name'            => $response->getName(),
                'email'           => $response->getEmail(),
                'password'        => null,
            ]);
        }
 
        auth()->login($user);
 
        return redirect()->intended(route('filament.admin.pages.dashboard'));
    }
 
    protected function validateProvider(string $provider): array
    {
           return Validator::make(
            ['provider' => $provider],
            ['provider' => 'in:google']
        )->validate();
    }
}
