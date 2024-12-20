<?php

namespace App\Controllers;

use App\Models\Menu;

class MenuController
{
    protected $menuModel;

    public function __construct($db)
    {
        // Передаем экземпляр подключения к базе данных в модель
        $this->menuModel = new Menu($db);  // $db - это объект mysqli
    }

    public function displayMenu()
    {
        // Получаем все элементы меню
        $menuItems = $this->menuModel->getMenuItems();

        // Обрабатываем вывод данных на страницу
        if (!empty($menuItems)) {
            foreach ($menuItems as $item) {
                echo "<p><strong>" . $item['name'] . ":</strong> " . $item['description'] . " - $" . $item['price'] . "</p>";
            }
        } else {
            echo "No menu items available.";
        }
    }
}
