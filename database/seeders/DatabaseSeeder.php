<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contract;
use App\Models\House;
use App\Models\HouseFeature;
use App\Models\HouseImage;
use App\Models\HouseReview;
use App\Models\HouseRule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory("house/images");
        Storage::createDirectory("house/images");

        $admin = User::factory()->create([ "username" => "admin" ]);

        $houses = House::factory(5)->create([ "user_id" => $admin->id ]);

        foreach($houses as $house)
        {
            HouseImage::factory(2)->create([ "house_id" => $house->id ]);
            HouseRule::factory(5)->create([ "house_id" => $house->id ]);
            HouseFeature::factory(5)->create([ "house_id" => $house->id ]);
            HouseReview::factory(5)->create([ "house_id" => $house->id ]);
            Contract::factory()->create([ "house_id" => $house->id,  ]);
        }

        $houses = House::factory(5)->create();

        foreach($houses as $house)
        {
            HouseImage::factory(2)->create([ "house_id" => $house->id ]);
            HouseRule::factory(5)->create([ "house_id" => $house->id ]);
            HouseFeature::factory(5)->create([ "house_id" => $house->id ]);
            HouseReview::factory(5)->create([ "house_id" => $house->id ]);
        }

        Contract::factory(5)->create([ "user_id" => $admin->id,  ]);
    }
}
