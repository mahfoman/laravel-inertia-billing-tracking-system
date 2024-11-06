<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return Inertia::render('Roles/Index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return Inertia::render('Roles/Create');
    }
}
