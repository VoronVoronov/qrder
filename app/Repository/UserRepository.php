<?php

namespace App\Repository;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws Exception
     */
    public function register(Request $request): array
    {
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'registration_ip' => $request->ip(),
            'registration_date' => now(),
        ]);
        if(!$user){
            throw new Exception('Системная ошибка. Попробуйте позже');
        }

        return ['token' => Auth::login($user), 'user' => $user];
    }

    /**
     * @throws Exception
     */
    public function login(Request $request): array
    {
        $credentials = $request->only('phone', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            throw new Exception('Вы ввели неверный email или пароль');
        }
        $user = Auth::user();
        User::where(['id' => $user->id])->update([
            'last_login_ip' => $request->ip(),
            'last_login_date' => now(),
        ]);
        return ['token' => $token, 'user' => $user];
    }

    /**
     * @throws Exception
     */
    public function profile(): array
    {
        $user = Auth::user();
        if(!$user){
            throw new Exception('Вы не авторизованы');
        }
        return ['user' => $user];
    }

}
