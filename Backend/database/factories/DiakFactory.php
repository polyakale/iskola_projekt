<?php

namespace Database\Factories;

use App\Helpers\VeletlenVaros;
use App\Models\Osztaly;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diak>
 */
class DiakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('hu_HU');
        
        $minDate = '2010-01-01';
        $maxDate = '2015-12-31';
        $randomDate = fake()->date('Y-m-d', $maxDate);
 
        // If the generated date is less than the minimum date, we will generate it again
        while ($randomDate < $minDate) {
            $randomDate = fake()->date('Y-m-d', $maxDate);
        }

        $neme = fake()->boolean();
        if ($neme) {
            # férfi
            $nev = $faker->lastName(). " " . $faker->firstNameMale();
        } else {
            # nő
            $nev = $faker->lastName(). " " . $faker->firstNameFemale();
        }
        
        $osztalyId = Osztaly::inRandomOrder()->first()->id;

        return [
            'osztalyId' => $osztalyId,
            'nev' => $nev,
            'neme' => $neme,
            'szuletett' => $randomDate,
            'helyseg' => $faker->city(),
            // 'helyseg' => VeletlenVaros::randomVaros(),
            'osztondij' => $faker->numberBetween(1000, 10000),
            'atlag' => $faker->randomFloat(1, 1, 5),
        ];
    }
}
