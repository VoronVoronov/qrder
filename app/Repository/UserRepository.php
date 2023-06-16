<?php

namespace App\Repository;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use App\Traits\UserLogsTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    use UserLogsTrait;
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
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'password' => Hash::make($request->password),
            'registration_ip' => $request->ip(),
            'registration_date' => now(),
        ]);
        if(!$user){
            throw new Exception(__('main.system.system_error'));
        }
        $this->userLogs($user, $request, __('main.system.registered'));
        return ['token' => Auth::login($user), 'user' => $user];
    }

    /**
     * @throws Exception
     */
    public function login(Request $request): array
    {
        $token = Auth::attempt([
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'password' => $request->password,
        ]);
        if (!$token) {
            throw new Exception(__('main.users.login.unauthorized'));
        }
        $status = User::where(['phone' => preg_replace('/[^0-9]/', '', $request->phone)])
            ->where(['status' => 1])
            ->first();
        if (!$status) {
            throw new Exception(__('main.users.login.blocked'));
        }
        $user = Auth::user();
        if (!$user) {
            throw new Exception(__('main.system.system_error'));
        }
        $last_login = User::where(['id' => $user->id])->update([
            'last_login_ip' => $request->ip(),
            'last_login_date' => now(),
        ]);
        if (!$last_login) {
            throw new Exception(__('main.system.system_error'));
        }
        $this->userLogs($user, $request, __('main.system.logged_in'));
        return ['token' => $token, 'user' => $user];
    }

    /**
     * @throws Exception
     */
    public function profile(): array
    {
        $user = Auth::user();
        if(!$user){
            throw new Exception(__('main.system.unauthorized'));
        }
        return ['user' => $user];
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
