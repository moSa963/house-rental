<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\HouseImage;
use App\Models\HouseFeature;
use App\Models\HouseRule;

class House extends Model
{
    use HasFactory, Uuid;
    protected $table = "houses";
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'name',
        'country',
        'city',
        'address',
        'lat',
        'lng',
        'zip',
        'night_cost',
        'active',
        'about',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(HouseImage::class);
    }

    public function features()
    {
        return $this->hasMany(HouseFeature::class);
    }

    public function rules()
    {
        return $this->hasMany(HouseRule::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function confirmed_contracts()
    {
        return $this->hasMany(Contract::class)->where("confirmed", true);
    }

    public function reviews()
    {
        return $this->hasMany(HouseReview::class);
    }
}
