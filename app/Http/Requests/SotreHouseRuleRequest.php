<?php

namespace App\Http\Requests;

use App\Models\House;
use App\Models\HouseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SotreHouseRuleRequest extends FormRequest
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
    public function add_rules(House $house){
        $roules = [];
        foreach($this->rule as $rule){
            $roules[] = HouseRule::create([
                'house_id' => $house->id,
                'rule' => $rule,
            ]);
        }
        return $roules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "rule" => ['required', 'array'],
            "rule.*" => ['string'],
        ];
    }
}
