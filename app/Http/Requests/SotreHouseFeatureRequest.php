<?php

namespace App\Http\Requests;

use App\Models\House;
use App\Models\HouseFeature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SotreHouseFeatureRequest extends FormRequest
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
     * Add new feautures to the house
     */
    public function add_feautures(House $house){
        $features = [];
        foreach($this->feature as $feature){
            $features[] = HouseFeature::create([
                'house_id' => $house->id,
                'feature' => $feature,
            ]);
        }
        return $features;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "feature" => ['required', 'array', 'min:1'],
            "feature.*" => ['string']
        ];
    }
}
