<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function displayUsers()
    {
        $userModel = new User($this->db);
        $users = $userModel->getAllUsers();
        require_once __DIR__ . '/../Views/users.php';
    }
}
