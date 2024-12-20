<?php

namespace App\Models;

class ReviewAPI
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM reviews");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO reviews (reviewer_name, review_text, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $data['reviewer_name'], $data['review_text'], $data['rating']);
        return $stmt->execute();
    }

    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE reviews SET reviewer_name = ?, review_text = ?, rating = ? WHERE id = ?");
        $stmt->bind_param("ssii", $data['reviewer_name'], $data['review_text'], $data['rating'], $data['id']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
