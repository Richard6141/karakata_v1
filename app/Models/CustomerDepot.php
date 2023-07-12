<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerDepot extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function customer ()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}