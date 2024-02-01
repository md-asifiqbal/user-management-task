<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index()
    {
        $users = $this->userService->index();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $this->userService->create($request->validated());
            $this->success(__('User Created Successfully'));
            $this->url = route('admin.users.index');
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
        return $this->output();
    }

    public function show($id)
    {
        $user = $this->userService->show($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->show($id);
        $params = [
            'modalTitle' => __('Update User'),
            'submitUrl' => route('admin.users.update', $id),
            'user' => $user,
        ];
        return view('admin.users.edit', $params);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $this->userService->update($id, $request->validated());
            $this->success(__('User Updated Successfully'));
            $this->url = route('admin.users.index');
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
        return $this->output();
    }

    public function destroy($id)
    {
        try {
            $data = $this->userService->delete($id);
            $this->success(__('User Deleted Successfully'));
            $this->url = route('admin.users.index');
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
        return $this->output();
    }
}
