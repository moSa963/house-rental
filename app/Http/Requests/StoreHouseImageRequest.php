<?php

namespace App\Http\Requests;

use App\Models\House;
use App\Models\HouseImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHouseImageRequest extends FormRequest
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

    //store images
    public function store_images(House $house){
        $images = [];
        //for each image
        foreach($this->file("image") as $image){
            //store it on the local storage
            $path = $image->store('house/images', 'local');

            if ($path){
                //create a database recored for it
                $images[] = HouseImage::create([
                    'house_id' => $house->id,
                    'name' => $path,
                ]);
            }
        }

        return $images;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "image" => ['required', 'array', 'min:1'],
            "image.*" => ['image']
        ];
    }
}
