<?php

namespace App\Http\Requests;

use App\Models\House;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Create a new home record using validated data
     *
     * @return House
     */
    public function store_house(User $user){
        $data = $this->validated();
        $data["user_id"] = $user->id;
        $data["active"] = true;
        return House::create($data);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ["required", "string", "max:300"],
            'country' => ["required", "string", "max:50"],
            'city' => ["required", "string", "max:50"],
            'address' => ["required", "string", "max:300"],
            'lat' => ["required", "integer"],
            'lng' => ["required", "integer"],
            'zip' => ["required", "string", "max:5", "min:5"],
            'night_cost' => ["required", "numeric"],
            'about' => ["required", "string"],
        ];
    }
}
