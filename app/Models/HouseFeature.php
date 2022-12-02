<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseFeature extends Model
{
    use HasFactory;
    protected $table = "house_features";

    protected $fillable = [
        'house_id',
        'feature',
    ];

    
    public function house(){
        return $this->belongsTo(House::class);
    }
}
