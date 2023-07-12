<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contain extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function paquet ()
    {
        return $this->belongsTo(Paquet::class, 'paquet_id');
    }

    public function component ()
    {
        return $this->belongsTo(Component::class, 'component_id');
    }

    public function componenttype ()
    {
        return $this->belongsTo(ComponentType::class, 'component_type_id');
    }
}
