<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
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
        if ( $company->logo && file_exists(public_path('storage/companies/' . $company->logo))) {
            File::delete(public_path('storage/companies/' . $company->logo));
        }
        $company->delete();
        return redirect()->back();
    }

    public function users(Company $company)
    {
        $company->load('users');
        // get all users that company doesn't have and role_id not 1
        $companyNotUsers = User::where('role_id', '<>' , 1)->whereNotIn('id', $company->users()->pluck('user_id'))->get();

        // get all users that company has
        $companyUsers = $company->users()->get();

        return response()->json([
            'company' => $company,
            'dropDownUsers' => $companyNotUsers,
            'tableUsers' => $companyUsers
        ]);
    }

    public function addUser(Request $request, Company $company)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $company->users()->attach($request->user_id);
        return redirect()->back()->with('success', 'User added to company successfully.');
    }

    public function companyUserdestroy(Company $company, User $user)
    {
        $company->users()->detach($user->id); // Detach the user from the company
        return response()->json(['message' => 'User removed successfully'], 200);
    }
}
