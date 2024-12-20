<?php

namespace App\Controllers;

use App\Models\Shape;

class ShapeController
{
    public function displayShape($num)
    {
        $shapeModel = new Shape();
        $svg = $shapeModel->generateSVG($num);
        require_once __DIR__ . '/../Views/shapes.php';
    }
}
