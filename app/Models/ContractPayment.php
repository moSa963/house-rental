<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPayment extends Model
{
    use HasFactory;
    protected $table = "contract_payments";

    protected $fillable = [
        'user_id',
        'contract_id',
        'name',
        'amount',
        'note',
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function contract(){
        return $this->belongsTo(Contract::class);
    }
}
