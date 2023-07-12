<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brouillon extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function paquet ()
    {
        return $this->belongsTo(Pack::class, 'pack_id');
    }

    public function component ()
    {
        return $this->belongsTo(Composants::class, 'component_id');
    }
}
