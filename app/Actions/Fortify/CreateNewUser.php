<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'social_title' => ['nullable', 'string', 'in:Sr.,Sra.'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'birthday' => ['nullable', 'date', 'before:today'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'social_title' => $input['social_title'] ?? null,
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'name' => $input['first_name'] . ' ' . $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'birthday' => $input['birthday'] ?? null,
            'newsletter' => isset($input['newsletter']) ? true : false,
            'opt_in' => isset($input['opt_in']) ? true : false,
        ]);
    }
}
