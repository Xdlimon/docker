<?php

namespace App\Controllers;

use App\Models\ReviewAPI;
require_once __DIR__ . '/../Models/ReviewAPI.php';

class ReviewAPIController
{
    public function handleRequest($db)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $review = new ReviewAPI($db);

        switch ($method) {
            case 'GET':
                echo json_encode($review->getAll());
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($review->create($data));
                break;
            case 'PUT':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($review->update($data));
                break;
            case 'DELETE':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($review->delete($data['id']));
                break;
            default:
                http_response_code(405);
                echo json_encode(["message" => "Method not allowed"]);
        }
    }
}
