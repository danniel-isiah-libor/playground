<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        // validate...
        $validatedForm = $request->validated();

        // logic...

        // saving...
        User::create($validatedForm);

        // $user = new User;
        // $user->name = $validatedForm['name'];
        // $user->email = $validatedForm['email'];
        // $user->save();

        // User::insert([
        //     [
        //         'name' => ''
        //     ],
        //     [
        //         'name' => ''
        //     ]
        // ]);

        // redirect...
        return redirect()->route('login');
    }
}
