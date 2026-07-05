<?php

namespace App\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use GuzzleHttp\RequestOptions;

class TrustLoginProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * Get the authentication URL for the provider.
     *
     * @param  string  $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->getConfig('auth_url'), $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return $this->getConfig('token_url');
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string  $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->getConfig('userinfo_url'), [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array  $user
     * @return \Laravel\Socialite\Two\User
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['sub'] ?? ($user['id'] ?? null),
            'nickname' => $user['nickname'] ?? null,
            'name' => $user['name'] ?? null,
            'email' => $user['email'] ?? null,
            'avatar' => $user['picture'] ?? null,
        ]);
    }

    /**
     * Get the configuration value for a given key.
     */
    protected function getConfig($key)
    {
        return config("services.trustlogin.{$key}");
    }
}
