<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function index(array $relations = [], array $columns = ['*'])
    {
        try {
            return $this->model->with($relations)->where('role', 'user')->select($columns)->get();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create(array $data): User
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show(string $id, array $relations = [], array $columns = ['*']): User
    {
        try {
            return $this->model->with($relations)->select($columns)->findOrFail($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(string $id, array $data): User
    {
        try {
            $user = $this->show($id);
            $user = tap($user)->update([
                'username' => $data['username'],
                'email' => $data['email'],
            ]);
            if (isset($data['password'])) {
                $user->password = $data['password'];
                $user->save();
            }
            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(string $id): bool
    {
        try {
            $user = $this->show($id);
            return $user->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
