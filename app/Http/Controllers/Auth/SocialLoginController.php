<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    private function configureProvider($provider)
    {
        $enabledField = $provider === 'trustlogin' ? 'trustlogin_enabled' : "{$provider}_login_enabled";
        $enabled = CompanySetting::get($enabledField, '0');
        if ($enabled !== '1' && $enabled !== true) {
            abort(404, "El login con {$provider} está desactivado.");
        }

        $config = [
            "services.{$provider}.client_id" => CompanySetting::get("{$provider}_client_id"),
            "services.{$provider}.client_secret" => CompanySetting::get("{$provider}_client_secret"),
            "services.{$provider}.redirect" => url("/login/{$provider}/callback"),
        ];

        if ($provider === 'trustlogin') {
            $config['services.trustlogin.auth_url'] = CompanySetting::get('trustlogin_auth_url');
            $config['services.trustlogin.token_url'] = CompanySetting::get('trustlogin_token_url');
            $config['services.trustlogin.userinfo_url'] = CompanySetting::get('trustlogin_userinfo_url');
        }

        config($config);
    }

    public function redirect($provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'trustlogin'])) {
            abort(404);
        }

        $this->configureProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'trustlogin'])) {
            abort(404);
        }

        $this->configureProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => "Error al autenticar con {$provider}."]);
        }

        // Check if a user with this email already exists
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update the social ID if it's not set
            $providerField = "{$provider}_id";
            if (!$user->{$providerField}) {
                $user->{$providerField} = $socialUser->getId();
                $user->save();
            }
        } else {
            // Create a new customer user
            $providerField = "{$provider}_id";
            $user = new User();
            $user->name = $socialUser->getName() ?? 'Usuario';
            $user->first_name = $socialUser->getName() ?? 'Usuario';
            $user->last_name = '';
            $user->email = $socialUser->getEmail();
            $user->password = Hash::make(Str::random(24)); // Random secure password
            $user->role = 'customer';
            $user->customer_group_id = 3; // Default 'Cliente'
            $user->is_enabled = true;
            $user->{$providerField} = $socialUser->getId();
            
            // Try to get avatar if needed
            if ($socialUser->getAvatar()) {
                $user->profile_photo_path = $socialUser->getAvatar();
            }
            
            $user->save();
        }

        if (!$user->is_enabled) {
            return redirect('/login')->withErrors(['email' => 'Tu cuenta ha sido deshabilitada. Contacta con soporte.']);
        }

        Auth::login($user);
        return redirect()->intended('/dashboard');
    }
}
