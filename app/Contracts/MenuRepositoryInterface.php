<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface MenuRepositoryInterface
{
    public function index();

    public function get($id);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);
}
