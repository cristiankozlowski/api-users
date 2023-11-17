<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function create(array $request)
    {
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password'])
        ];

        return $this->entity->create($data);
    }

    public function show(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first();
    }
}
