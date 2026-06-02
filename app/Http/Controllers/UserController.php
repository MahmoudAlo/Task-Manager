<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function GetUser()
    {
        $id = Auth::user()->id;
        $user_data = User::with('profile')->findOrFail($id);
        return new UserResource($user_data);
    }
    public function getAllUsers()
    {
        $task = Task::all();

        return response()->json($task, 200);
    }

    public function register(RegisterRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($request->password);
        $user = User::create($validatedData);

        return response()->json(['massege' => 'user creeted successfully', 'user' => $user], 201);
    }

    public function login(LoginRequest $request)
    {

        $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['invalide email or password'], 401);
        } else {
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_Token')->plainTextToken;
            return response()->json(
                ['massege' => 'login successfully', 'user' => $user, 'Token' => $token],
                201
            );
        }


    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('logout successful');

    }

    public function getProfile($id)
    {
        $profile = User::find($id)->profile;
        return response()->json($profile, 200);

    }
    public function getTasks($id)
    {
        $task = User::find($id)->tasks;
        return response()->json($task, 200);
    }
}
