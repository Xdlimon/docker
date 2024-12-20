<?php

namespace App\Controllers;

use App\Models\Sorter;

class SortController
{
    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получаем входные данные
            $input = file_get_contents('php://input');
            $numbers = json_decode($input, true);

            if (is_array($numbers)) {
                // Выполняем сортировку
                $sorted = Sorter::insertionSort($numbers);

                // Отправляем ответ
                header('Content-Type: application/json');
                echo json_encode($sorted);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Invalid input. Expecting a JSON array."]);
            }
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed."]);
        }
    }
}
