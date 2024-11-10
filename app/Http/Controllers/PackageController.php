<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(10);
        return Inertia::render('Package/Index', compact('packages'));
    }

    public function create()
    {
        return Inertia::render('Package/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'speed' => 'required|integer',
            'description' => 'nullable|string|max:255',
        ]);
        Package::create($request->all());
        return redirect()->route('packages.index');
    }

    public function edit(Package $package)
    {
        return Inertia::render('Package/Create', ['package' => $package, 'isUpdating' => true]);
    }


    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'speed' => 'required|integer',
            'description' => 'nullable|string|max:255',
        ]);
        $package->update($request->all());
        return redirect()->route('packages.edit', $package);
    }


    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index');
    }


}
