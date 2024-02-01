<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Users\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.home');
    }

    public function profile()
    {
        $params = [
            'modalTitle'=>'Update Profile',
            'submitUrl' => route('profile.update'),
            'user' => auth()->user(),
        ];
        return view('users.profile', $params);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        try {
            $userService = new UserService();
            $data = $userService->update(auth()->id(), $request->validated());
            $this->success(__('Profile Updated Successfully'));
            $this->url = route('home');
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
        return $this->output();
    }
}
