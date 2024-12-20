<?php

namespace App\Models;

class Shape
{
    private $shapes = ["rectangle", "circle", "ellipse", "polygon"];
    private $colors = ["red", "green", "blue", "yellow", "black"];
    private $sizes = [50, 100, 150, 200];
    private $positions = [10, 20, 30, 40];

    public function generateSVG($num)
    {
        $shapeIndex = ($num >> 12) & 0x3;
        $colorIndex = ($num >> 8) & 0xF;
        $sizeIndex = ($num >> 4) & 0x3;
        $posIndex = $num & 0x3;

        $shape = $this->shapes[$shapeIndex] ?? "rectangle";
        $color = $this->colors[$colorIndex] ?? "black";
        $size = $this->sizes[$sizeIndex] ?? 50;
        $pos = $this->positions[$posIndex] ?? 10;

        $svg = '<svg width="500" height="500" xmlns="http://www.w3.org/2000/svg">';
        switch ($shape) {
            case 'rectangle':
                $svg .= "<rect width='$size' height='$size' x='$pos' y='$pos' fill='$color' />";
                break;
            case 'circle':
                $svg .= "<circle cx='" . ($pos + $size / 2) . "' cy='" . ($pos + $size / 2) . "' r='" . ($size / 2) . "' fill='$color' />";
                break;
            case 'ellipse':
                $svg .= "<ellipse cx='" . ($pos + $size / 2) . "' cy='" . ($pos + $size / 3) . "' rx='" . ($size / 2) . "' ry='" . ($size / 3) . "' fill='$color' />";
                break;
            case 'polygon':
                $svg .= "<polygon points='$pos,$pos," . ($pos + $size) . "," . ($pos + $size / 2) . "," . ($pos + $size / 2) . "," . ($pos + $size) . "' fill='$color' />";
                break;
            default:
                $svg .= '<text x="10" y="20">Unknown Shape</text>';
        }
        $svg .= '</svg>';

        return $svg;
    }
}
