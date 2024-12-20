<?php

namespace App\Models;

use mysqli;

class Menu
{
    protected $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    // Метод для получения всех элементов меню
    public function getMenuItems()
    {
        $sql = "SELECT name, description, price FROM menu_items";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Используем fetch_assoc() в цикле для получения всех строк
            $menuItems = [];
            while ($row = $result->fetch_assoc()) {
                $menuItems[] = $row;  // Добавляем строку в массив
            }
            return $menuItems;  // Возвращаем массив с элементами меню
        } else {
            return [];  // Если нет элементов, возвращаем пустой массив
        }
    }
}
