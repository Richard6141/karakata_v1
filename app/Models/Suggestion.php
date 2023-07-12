<?php

namespace App\Models;

use App\Models\Source;
use App\Traits\HasUuid;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestion extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

     public function customer ()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

     public function source ()
    {
        return $this->belongsTo(Source::class, 'sources_id');
    }
}
