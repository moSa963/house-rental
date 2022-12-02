<?php

namespace App\Http\Requests;

use App\Models\Contract;
use App\Models\House;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreContractRequest extends FormRequest
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
     * Create a new contract.
     *
     * @return Contract
     */
    public function store_contract(House $house, $total_price){
        return Contract::create([
            'user_id' => Auth::user()->id,
            'house_id' => $house->id,
            'guests' => $this->guests,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_price' => $total_price,
            'confirmed' => false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'guests' => ["required", "integer"],
            'start_date' => ["required", "date", "date_format:Y-m-d", "after:today", "before:end_date"],
            'end_date' => ["required", "date", "date_format:Y-m-d", "after:start_date"],
        ];
    }
}
