<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function componentType ()
    {
        return $this->belongsTo(ComponentType::class, 'component_type_id');
    }

    
}
