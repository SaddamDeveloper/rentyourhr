<?php

use App\City;
use App\Country;
use App\State;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::create([
            "name" => "India",
            "code" => "+91",
        ]);
        $state = State::create([
            "name"       => "West Bengal",
            "country_id" => $country->id,
        ]);
        $city = City::create([
            "name"     => "Kolkata",
            "state_id" => $state->id,
        ]);
    }
}
