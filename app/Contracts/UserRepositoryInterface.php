<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function register(Request $request);

    public function login(Request $request);

    public function profile();

    public function logout();
}
