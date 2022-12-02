<?php

namespace App\Http\Requests;

use App\Models\House;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateHouseRequest extends FormRequest
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
     * Update a home record using validated data
     *
     * @return House
     */
    public function update_house(House $house){
        $data = $this->validated();
        $house->update($data);
        return $house;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ["string", "max:300"],
            'night_cost' => ["numeric"],
            'about' => ["string"],
            'active' => ["integer"],
        ];
    }
}
