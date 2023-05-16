<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
// use App\HttpRespones\HttpRespones;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // use HttpRespones;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(LoginRequest $request)
    {
        $request->validated($request->all());
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            return response()->json(
                [
                    'message' => "the user's credentials that you gives was invalide",
                ], 401
            );
        }

        $user = Auth::user();
        $token = $user->createToken("User Token of $user->name");

        return response()->json([
            'user' => $user,
            'message' => 'login successfully',
        ], 200);
    }
    public function logout(Request $request, Response $response)
    {
        $user = $request->user();
        try {
            // check if the request has remember me in cookies
            if ($request->hasCookie('remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')) {
                // change the expire date to old date so the browser well delete it the cookie
                $response->withCookie(Cookie::forget('remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d', '/', '', true, true));
                $user->remember_token = null;
                $saved = $user->save(); //save the change in database
            }
            // remove the access token of Auth user
            Auth::user()->tokens()->delete();
            Session::flush();
            Session::regenerate(true);
            return $response; // return new respone

        } catch (\Exception$e) {
            return response()->json([
                'message' => 'the user logout failed' . $e,
                'state' => 0,
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        // $request->validated($request->all());
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(
            [
                'user' => $user,
            ], 201
        );
    }
}
