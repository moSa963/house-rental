<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    use HasFactory;
    protected $table = "house_images";

    protected $fillable = [
        'house_id',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     */
    protected $hidden = [
        'name',
    ];


    public function house(){
        return $this->belongsTo(House::class);
    }
}
