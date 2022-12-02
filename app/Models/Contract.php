<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = "contracts";

    protected $fillable = [
        'user_id',
        'house_id',
        'guests',
        'start_date',
        'end_date',
        'total_price',
        'confirmed',
    ];

    public function payment(){
        return $this->hasOne(ContractPayment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function owner(){
        return $this->hasOneThrough(User::class, House::class, "id", "id", "house_id", "user_id");
    }

    public function house(){
        return $this->belongsTo(House::class);
    }
}
