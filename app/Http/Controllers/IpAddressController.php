<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IpAddressController extends Controller
{
    //
    public function index()
    {
        $ips = IpAddress::all();
        return Inertia::render('IpAddress/Index', [
            'ips' => $ips
        ]);
    }

    public function create()
    {
        return Inertia::render('IpAddress/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|ip|string|max:255',
        ]);

        $ipAddress = new IpAddress($request->all());
        $ipAddress->save();
        return redirect()->route('ip_addresses.index');
    }

    public function edit(IpAddress $ipAddress)
    {
        return Inertia::render('IpAddress/Create', ['ipAddress' => $ipAddress, 'isUpdating' => true]);
    }

    public function update(Request $request, IpAddress $ipAddress)
    {
        $request->validate([
            'ip_address' => 'required|ip|string|max:255',
        ]);

        $ipAddress->update($request->all());
        return redirect()->route('ip_addresses.index');
    }

    public function destroy(IpAddress $ipAddress)
    {
        $ipAddress->delete();
        return redirect()->back();
    }
}
