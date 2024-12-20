<?php
namespace App\Controllers;

use App\Models\Review;

class ReviewController
{
    protected $reviewModel;

    public function __construct($db)
    {
        // Передаем экземпляр подключения к базе данных в модель
        $this->reviewModel = new Review($db);  // $db - это объект mysqli
    }

    public function displayReviews()
    {
        // Получаем все отзывы
        $reviews = $this->reviewModel->getReviews();

        // Обработка вывода данных на страницу
        if (!empty($reviews)) {
            foreach ($reviews as $review) {
                echo "<p><strong>" . $review['reviewer_name'] . ":</strong> " . $review['review_text'] . " - Rating: " . $review['rating'] . "/5</p>";
            }
        } else {
            echo "No reviews available.";
        }
    }
}
