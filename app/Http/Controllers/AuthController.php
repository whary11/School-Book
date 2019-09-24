<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthController extends FatherController
{
    // public function signup(RegisterRequest $request)
    // {
    //     $user = new User([
    //         'name'     => $request->name,
    //         'email'    => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);
    //     $user->save();
    //     $user->assignRole('SUPERUSUARIO');


    //     return response()->json([
    //         'message' => 'Successfully created user!'
    //     ], 201);
    // }
    public function login(Request $request)
    {
        // return $request;


        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return
                response()->json([
                    'message' => 'Unauthorized'
                ], 401, [], JSON_UNESCAPED_UNICODE);
        }




        $user = $request->user();


        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        // return true;


        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'user'  => Auth::user(),
            'permisos' => Auth::user()->allPermissions,
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at
            )
                ->toDateTimeString(),
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->responseApp([], true, ['type' => 'success', 'content' => 'Closed']);
    }

    // public function user(Request $request)
    // {
    //     // return $request->user()->id;
    //     $user = $request->user();
    //     // $role = Role::create(['guard_name' => 'api', 'name' => 'ID']);
    //     //  $user->assignRole('ID');
    //     // $user->syncPermissions(['edit imos', 'delete imos']);

    //     // $user->syncPermissions('edit imos');

    //     return $user->getRoleNames();
    //     dd($user->getRoleNames());
    //     // return response()->json($user);
    // }
}
