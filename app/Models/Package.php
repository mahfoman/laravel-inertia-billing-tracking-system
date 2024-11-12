<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','name', 'price', 'speed', 'description'];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
