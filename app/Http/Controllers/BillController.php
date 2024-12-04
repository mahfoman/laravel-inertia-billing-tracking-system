<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Company;
use App\Models\IpAddress;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class BillController extends Controller
{
    //
    public function index(){

        $bills = Bill::with(['company', 'user', 'package', 'ip_address'])->paginate(10);
        return Inertia::render('Bill/Index', compact('bills'));
    }

    public function create()
    {
        $companies = Company::all();
        $users = [];
        //dd($users);
        $packages = Package::all();
        $ip_addresses = IpAddress::all();

        $currentYear = Carbon::now()->year;
        // Generating an array with 'YYYY-MM' format for the 12 months of the current year
        $months = collect(range(1, 12))->map(function ($month) use ($currentYear) {
            return Carbon::create($currentYear, $month)->format('Y-m');
        });
//        dd($months);

        return Inertia::render('Bill/Create', compact('companies', 'users', 'packages', 'ip_addresses', 'months'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|integer',
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'ip_address_id' => 'required|integer',
            'billing_month' => 'required|string|max:255',
        ]);
        Bill::create($request->all());
        return redirect()->route('bills.index');
    }

    public function edit(Bill $bill){
        $companies = Company::all();
        $users = User::whereNotIn('role_id', [1, 2, 3])->get();
        //dd($users);
        $packages = Package::all();
        $ip_addresses = IpAddress::all();

        $currentYear = Carbon::now()->year;
        // Generating an array with 'YYYY-MM' format for the 12 months of the current year
        $months = collect(range(1, 12))->map(function ($month) use ($currentYear) {
            return Carbon::create($currentYear, $month)->format('Y-m');
        });
        $isUpdating = true;
//        dd($months);
        return Inertia::render('Bill/Create', compact('companies', 'users', 'packages', 'ip_addresses', 'months', 'bill', 'isUpdating'));
    }

    public function update(Request $request, Bill $bill){
        $request->validate([
            'company_id' => 'required|integer',
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'ip_address_id' => 'required|integer',
            'billing_month' => 'required|string|max:255',
        ]);

        $bill->update($request->all() + ['paid_on' => $request->status == 'paid' ? Carbon::now() : null]);
        return redirect()->route('bills.edit', $bill);
    }

    public function destroy(Bill $bill){
        $bill->delete();
        return redirect()->route('bills.index');
    }


}
