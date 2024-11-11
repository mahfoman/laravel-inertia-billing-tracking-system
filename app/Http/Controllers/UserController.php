<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return Inertia::render('User/Index', compact('users', ));
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('User/Create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            //'password' => 'required|max:30',
            'role_id' => 'required|integer',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($data);

        //dd($request->address);

        $user->customer()->create([
            'address' => $request->address,
            'phone' => $request->phone,
            'floor' => $request->floor
        ]);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $user->load('customer');
        $roles = Role::all();
        return Inertia::render('User/Create', ['user' => $user, 'isUpdating' => true, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required|integer',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ];

        if( !empty($request->password) ) { // value of password field will be hashed if not empty
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->customer()->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'floor' => $request->floor
        ]);

        return redirect()->route('users.edit', $user);
    }

    public function destroy(User $user)
    {
        $user->load('customer');
        if( $user->customer()->count() > 0 ) {
            $user->customer()->delete();
        }
        $user->delete();
        return redirect()->route('users.index');
    }


}
