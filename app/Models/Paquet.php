<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paquet extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function paquetType ()
    {
        return $this->belongsTo(PaquetType::class, 'paquet_type_id');
    }

    public function component()
    {
        return $this->belongsTo(Component::class, 'component_id');
    }

}
