<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function particular()
    {
        return $this->belongsTo(Particular::class, 'paricular_id');
    }
    public function deliver()
    {
        return $this->belongsTo(Deliver::class, 'deliver_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function receiver()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id');
    }

    public function paquet()
    {
        return $this->belongsTo(Paquet::class, 'paquet_id');
    }

    public function address ()
    {
        return $this->belongsTo(AddressBook::class, 'address_book_id');
    }
}
