<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;

use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7',
            'user_level' => 'required'
        ]);

        $storeToDatabase = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_level' => $request->user_level,
            'api_token' => bcrypt($request->email.$request->password)
        ]);

        $response = fractal()
                        ->item($storeToDatabase)
                        ->transformWith(new UserTransformer)
                        ->toArray();
        return response()->json($response, 201);
    }

    public function login(Request $request, User $user)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Your credential is wrong'], 401);
        }

        $findUser = $user->findOrFail(Auth::user()->id);

        $response = fractal()
                        ->item($findUser)
                        ->transformWith(new UserTransformer)
                        ->addMeta(['token' => $findUser->api_token])
                        ->toArray();
        return response()->json($response, 200);
    }
}
