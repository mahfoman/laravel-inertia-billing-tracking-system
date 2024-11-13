<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'package_id',
        'ip_address_id',
        'billing_month',
        'package_name',
        'amount',
        'speed',
        'status',
        'paid_on',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function ip_address()
    {
        return $this->belongsTo(IpAddress::class);
    }


}
