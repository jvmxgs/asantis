<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Role;

class RepresentativesController extends Controller
{

    public function index()
    {
        return $representatives = User::whereHas('role', function ($query) {
            $query->where('name', 'representative');
        })->orderBy('updated_at', 'DESC')->get();
    }

    public function show($id)
    {
        $representative = User::find($id);
        return $representative;
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }


        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function updatepassword(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }


        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

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


        $role_id = Role::where('name', 'representative')->first()->id;

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $role_id;
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
