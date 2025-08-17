<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\InactiveAccountException;
use App\Exceptions\Auth\InvalidCredentialsException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\UserRolePremission\UserPermissionService;

class AuthService
{
    public function __construct(private UserPermissionService $userPermissionService)
    {
        // Constructor injection for UserPermissionService
    }
    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }


        if (!$user->isActive()) {
            throw new InactiveAccountException();
        }



        // Generate a new token (DO NOT return it directly)
        $token = $user->createToken('auth_token')->plainTextToken;


        return [
            'profile' => $user,
            'role' => $user->roles->first()->name,
            'permissions' => $this->userPermissionService->getUserPermissions($user),
            'tokenDetails' => [
                'token' => $token,
                'expiresIn' => null
            ],
        ];

    }

    public function logout()
    {
        $user = auth()->user();

        if ($user) {
            //$user->tokens()->delete(); // Revoke all tokens
            $user->currentAccessToken()->delete();
        }
    }
}
