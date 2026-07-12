<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passkeys\Actions\GenerateVerificationOptions;
use Laravel\Passkeys\Contracts\PasskeyUser;
use Laravel\Passkeys\Support\WebAuthn;

class PasskeyLoginOptionsController extends Controller
{
    public function __invoke(Request $request, GenerateVerificationOptions $generate): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user instanceof PasskeyUser || ! $user->hasPasskeysEnabled() || ! $user->is_enabled) {
            return response()->json([
                'message' => 'No encontramos una passkey activa para este correo.',
            ], 422);
        }

        $options = $generate($user);

        $request->session()->put('passkey.verification_options', WebAuthn::toJson($options));

        return response()->json([
            'options' => WebAuthn::toBrowserArray($options),
        ]);
    }
}
