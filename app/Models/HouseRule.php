<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseRule extends Model
{
    use HasFactory;
    protected $table = "house_rules";

    protected $fillable = [
        'house_id',
        'rule',
    ];

    
    public function house(){
        return $this->belongsTo(House::class);
    }
}
