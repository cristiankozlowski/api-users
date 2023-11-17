<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function show(string $uuid);
}
