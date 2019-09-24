<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $roles_public = config('constants.roles_public');

        if (in_array($request->role, $roles_public))  {
            $role = $request->role;
        } else {
            $role = $roles_public[0];
        }

        $role_id = Role::where('name', $role)->first()->id;

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $role_id;
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(!filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
            $credentials['username'] = $credentials['email'];
            unset($credentials['email']);
        }

        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user['role'] = Role::find($user->role_id)->name;
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', 'Bearer ' . $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }


    private function guard()
    {
        return Auth::guard();
    }
}
