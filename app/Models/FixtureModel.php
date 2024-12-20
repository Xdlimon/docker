<?php
namespace App\Models;

use Faker\Factory;
require_once '/var/www/html/vendor/autoload.php';

class FixtureModel
{
    public function generateFixtures($count = 50, $outputPath = '/var/www/html/users.json')
    {
        $faker = Factory::create();
        $users = [];

        for ($i = 0; $i < $count; $i++) {
            $birthYear = $faker->numberBetween(1950, 2020);
            $currentYear = date('Y');
            $age = $currentYear - $birthYear;

            $users[] = [
                'id' => $i + 1,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'birth_year' => $birthYear,
                'age' => $age,
                'gender' => $faker->randomElement(['Male', 'Female']),
            ];
        }

        file_put_contents($outputPath, json_encode($users, JSON_PRETTY_PRINT));
        return $outputPath;
    }

    public function getFixtures($path = '/var/www/html/users.json')
    {
        if (!file_exists($path)) {
            throw new \Exception("Fixture file not found at {$path}");
        }
        return json_decode(file_get_contents($path), true);
    }
}
