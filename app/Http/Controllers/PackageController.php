<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('company')->paginate(10);
        return Inertia::render('Package/Index', compact('packages'));
    }

    public function create()
    {
        $companies = Company::all();
        return Inertia::render('Package/Create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal',
            'speed' => 'required|integer',
            'description' => 'nullable|string|max:255',
            'company_id' => 'required|integer',
        ]);
        Package::create($request->all());
        return redirect()->route('packages.index');
    }

    public function edit(Package $package)
    {
        //$package->load('company');
//        dd($package);
        $companies = Company::all();
        return Inertia::render('Package/Create', ['package' => $package, 'isUpdating' => true, 'companies' => $companies]);
    }


    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal:2',
            'speed' => 'required|integer',
            'description' => 'nullable|string|max:255',
            'company_id' => 'required|integer',
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
