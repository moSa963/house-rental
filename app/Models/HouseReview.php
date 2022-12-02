<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\House;

class HouseReview extends Model
{
    use HasFactory;
    protected $table = "house_reviews";

    protected $fillable = [
        'user_id',
        'house_id',
        'comment',
        'rating',
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    
    public function house(){
        return $this->belongsTo(House::class);
    }

}
