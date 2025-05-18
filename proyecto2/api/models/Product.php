<?php

$base_url = '/proyecto2'; 

class Product {
    private $conn;
    private $table = 'products';

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT 
            p.id, 
            p.name, 
            p.description, 
            p.price, 
            p.category_id, 
            c.name as category_name,
            p.created_at,
            p.updated_at
        FROM ' . $this->table . ' p
        LEFT JOIN categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT 
            p.id, 
            p.name, 
            p.description, 
            p.price, 
            p.category_id, 
            c.name as category_name,
            p.created_at,
            p.updated_at
        FROM ' . $this->table . ' p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
            SET name = :name, 
                description = :description, 
                price = :price, 
                category_id = :category_id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
            SET name = :name, 
                description = :description, 
                price = :price, 
                category_id = :category_id
            WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>