<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $companies = Company::paginate(10);
//        $ips = IpAddress::
        return Inertia::render('Company/Index', compact('companies'));
    }

    public function create()
    {
        return Inertia::render('Company/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:companies,email',
            'phone' => 'required',
            'website' => 'nullable|url',
        ]);

        //dd($request->all());
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            // Creating a unique file name to avoid overwriting
            $fileName = $originalName . '_' . time() . '.' . $extension;
            $file->storeAs('companies', $fileName, 'public');
            $request->logo = $fileName;
        }

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'logo' => $request->logo
        ]);
        return redirect()->route('companies.index');
    }

    public function edit(Company $company)
    {
        return Inertia::render('Company/Create', ['company' => $company, 'isUpdating' => true]);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'phone' => 'required',
            'website' => 'nullable|url',
        ]);

        $fileName = null;
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            // Creating a unique file name to avoid overwriting
            $fileName = $originalName . '_' . time() . '.' . $extension;
            $file->storeAs('companies', $fileName, 'public');
        }

        $request->logo = $fileName ?? $company->logo;
        //dd($request->all());

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'logo' => $request->logo
            ]);

        return redirect()->route('companies.edit', $company);
    }

    public function destroy(Company $company)
    {
        if ( $company->logo &&file_exists(public_path('companies/' . $company->logo))) {
            File::delete(public_path('companies/' . $company->logo));
        }
        $company->delete();
        return redirect()->back();
    }
}
