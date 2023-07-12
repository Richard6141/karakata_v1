<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function particular ()
    {
        return $this->belongsTo(Particular::class, 'particulars_id');
    }

    public function company ()
    {
        return $this->belongsTo(Company::class, 'companies_id');
    }
}
