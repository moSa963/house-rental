<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseImageRequest;
use App\Http\Resources\HouseImageResource;
use App\Models\House;
use App\Models\HouseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseImageController extends Controller
{
    public function create(Request $request, House $house, HouseImage $image){
        if (!Storage::exists($image->name)) {
            return redirect("images/house.png");
        }
        
        return Storage::download($image->name);
    }

    public function store(StoreHouseImageRequest $request, House $house){
        $this->authorize("update", $house);
        
        $images = $request->store_images($house);

        return HouseImageResource::collection($images);
    }

    public function destroy(Request $request, House $house, HouseImage $image){
        $this->authorize("update", $house);

        if(Storage::exists($image->name)){
            abort_if(! Storage::delete($image->name), 404);
        }

        $image->delete();

        return response()->noContent();
    }
}
