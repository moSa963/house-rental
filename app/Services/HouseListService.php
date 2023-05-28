<?php

namespace App\Services;

use App\Models\House;

class HouseListService
{
    private $city;
    private $country;
    private $username;
    
    public function filterCity($city_key) : HouseListService{
        $this->city = $city_key;
        return $this;
    }

    public function filterCountry($country_key) : HouseListService{
        $this->country = $country_key;
        return $this;
    }

    public function filterUsername($username_key) : HouseListService{
        $this->username = $username_key;
        return $this;
    }

    public function get(){
        $houses = House::query();

        $houses->select("houses.*");

        if ($this->country){
            $houses = $houses->where("country", "LIKE", $this->country."%");
        }
        
        if ($this->city){
            $houses = $houses->where("city", "LIKE", $this->city."%");
        }

        if ($this->username){
            $houses = $houses->join("users", "users.id", "=", "houses.user_id")->where("users.username", $this->username);
        }

        $houses->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');

        return $houses->simplePaginate(10)->withQueryString();
    }

}