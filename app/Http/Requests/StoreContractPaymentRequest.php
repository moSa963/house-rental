<?php

namespace App\Http\Requests;

use App\Models\Contract;
use App\Models\ContractPayment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreContractPaymentRequest extends FormRequest
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

    public function store_payment(Contract $contract, $amount){
        ContractPayment::create([
            'user_id' => Auth::user()->id,
            'contract_id' => $contract->id,
            'amount' => $amount,
            'name' => $this->name,
            'note' => "",
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
            'name' => ["required", "string"],
            'card_number' => ["required", "string"],
            'security_code' => ["required", "string"],
            'expiry_month' => ["required"],
            'expiry_year' => ["required"],
            'note' => ["string"],
        ];
    }
}
