<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        $companies = Company::all();
        return Inertia::render('User/Create', compact('roles', 'companies'));
    }

    public function store(Request $request)
    {
        $validation = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            //'password' => 'required|max:30',
            'role_id' => 'required|integer',
        ];

        if( $request->role_id == 4 ) {
            $validation['address'] = 'required|string|max:255';
            $validation['phone'] = 'required|string|max:255';
            $validation['floor'] = 'required|string|max:255';
        }else{
            $validation['company_id'] = 'required|integer';
        }

        $request->validate($validation);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($data);

        if( $request->role_id == 4 ) {
            $user->customer()->create([
                'address' => $request->address,
                'phone' => $request->phone,
                'floor' => $request->floor
            ]);
        }else{
            $user->companies()->attach($request->company_id);
        }

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $user->load(['customer', 'companies']);
//        dd($user);
        $roles = Role::all();
        $companies = Company::all();
        return Inertia::render('User/Create', ['user' => $user, 'isUpdating' => true, 'roles' => $roles, 'companies' => $companies]);
    }

    public function update(Request $request, User $user)
    {
        $validation = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            //'password' => 'required|max:30',
            'role_id' => 'required|integer',
        ];

        if( $request->role_id == 4 ) {
            $validation['address'] = 'required|string|max:255';
            $validation['phone'] = 'required|string|max:255';
            $validation['floor'] = 'required|string|max:255';
        }else{
            $validation['company_id'] = 'required|integer';
        }

        $request->validate($validation);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ];

        if( !empty($request->password) ) { // value of password field will be hashed if not empty
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if($request->role_id == 4) {
            $user->customer()->update([
                'address' => $request->address,
                'phone' => $request->phone,
                'floor' => $request->floor
            ]);
        }else{
            $user->companies()->detach();
            $user->companies()->attach($request->company_id);
        }

        return redirect()->route('users.edit', $user);
    }

    public function destroy(User $user)
    {
        $user->load(['customer','companies']);
        if( $user->customer()->count() > 0 ) {
            $user->customer()->delete();
        }
        if( $user->companies()->count() > 0 ) {
            $user->companies()->detach();
        }
        $user->delete();
        return redirect()->route('users.index');
    }


}
