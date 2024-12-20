<?php

namespace App\Models;

class MenuAPI
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM menu_items");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO menu_items (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $data['name'], $data['description'], $data['price']);
        $stmt->execute();
        return ["id" => $stmt->insert_id];
    }

    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE menu_items SET name = ?, description = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $data['name'], $data['description'], $data['price'], $data['id']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM menu_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
