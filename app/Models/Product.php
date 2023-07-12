<?php

namespace App\Models;

use App\Models\User;
use App\Traits\HasUuid;
use App\Models\UnitOfMeasure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];
     public function unitemesure ()
    {
        return $this->belongsTo(UnitOfMeasure::class, 'uniteofmesure_id');
    }

    public function user ()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function type()
    {
        return $this->belongsTo(TypeOfOperations::class, 'typeOfOperation_id');
    }
}
