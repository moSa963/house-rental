<?php

namespace App\Http\Requests;

use App\Models\House;
use App\Models\HouseReview;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHouseReviewRequest extends FormRequest
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
     * Store or update house review 
     */
    public function store_review(House $house){
        return HouseReview::updateOrCreate([
            'user_id' => Auth::user()->id,
            'house_id' => $house->id
        ],[
            'comment' => $this->comment,
            'rating' => $this->rating,
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
            'comment' => ["string", ],
            'rating' => ["required", "integer", "min:1", "max:5"],
        ];
    }
}
