<?php

namespace App\Controllers;

use App\Models\MenuAPI;
require_once __DIR__ . '/../Models/MenuAPI.php';

class MenuAPIController
{
    public function handleRequest($db)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $menu = new MenuAPI($db);

        switch ($method) {
            case 'GET':
                echo json_encode($menu->getAll());
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($menu->create($data));
                break;
            case 'PUT':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($menu->update($data));
                break;
            case 'DELETE':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode($menu->delete($data['id']));
                break;
            default:
                http_response_code(405);
                echo json_encode(["message" => "Method not allowed"]);
        }
    }
}
