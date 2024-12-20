<?php
namespace App\Controllers;

use App\Models\FixtureModel;
require_once __DIR__ . '/../Models/FixtureModel.php';

class ChartController
{
    protected $fixtureModel;

    public function __construct()
    {
        $this->fixtureModel = new FixtureModel();
    }

    public function generateFixtures()
    {
        $path = $this->fixtureModel->generateFixtures();
        echo "Fixtures generated and saved at: {$path}";
    }

    public function getChartData()
    {
        $users = $this->fixtureModel->getFixtures();

        // Данные для графиков
        $birthYearCounts = [];
        $ageDistribution = [
            '0-18' => 0,
            '19-35' => 0,
            '36-50' => 0,
            '51+' => 0,
        ];
        $genderCounts = ['Male' => 0, 'Female' => 0];

        foreach ($users as $user) {
            // По годам рождения
            $year = $user['birth_year'];
            $birthYearCounts[$year] = ($birthYearCounts[$year] ?? 0) + 1;

            // По возрастным группам
            $age = $user['age'];
            if ($age <= 18) $ageDistribution['0-18']++;
            elseif ($age <= 35) $ageDistribution['19-35']++;
            elseif ($age <= 50) $ageDistribution['36-50']++;
            else $ageDistribution['51+']++;

            // По полу
            $gender = $user['gender'];
            $genderCounts[$gender]++;
        }

        return [
            'birthYearCounts' => $birthYearCounts,
            'ageDistribution' => $ageDistribution,
            'genderCounts' => $genderCounts,
        ];
    }
}
