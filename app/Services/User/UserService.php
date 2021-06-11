<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserService {

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function register($request)
    {
        $data = $request->only([
            'first_name',
            'last_last',
            'email',
            'password',
        ]);

        $data['password'] = Hash::make($data['password']);
        return $this->model->create($data);
    }

}
