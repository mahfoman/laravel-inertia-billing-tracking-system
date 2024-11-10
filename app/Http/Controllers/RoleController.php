<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return Inertia::render('Role/Index', compact('roles'));
    }

    public function create()
    {
        return Inertia::render('Role/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Role::create($request->all());
        return redirect()->route('roles.index');
    }


    public function edit(Role $role)
    {
        return Inertia::render('Role/Create', ['role' => $role, 'isUpdating' => true]);
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $role->update($request->all());
        return redirect()->route('roles.edit', $role);
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
