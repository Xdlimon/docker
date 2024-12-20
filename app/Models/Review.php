<?php

namespace App\Models;

use mysqli;

class Review
{
    protected $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    // Метод для получения всех отзывов
    public function getReviews()
    {
        $sql = "SELECT reviewer_name, review_text, rating FROM reviews";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Используем fetch_assoc() в цикле, чтобы получить все результаты
            $reviews = [];
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
            return $reviews;  // Возвращаем массив с отзывами
        } else {
            return [];  // Если отзывов нет, возвращаем пустой массив
        }
    }
}
