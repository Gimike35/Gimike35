<?php


class CRUD {
    private $conn;

    
    public function __construct() {
        include_once 'db_connect.php'; 
        $this->conn = $connection; 
    }

    // Create new content
    public function createContent($table, $data) {
        $query = "INSERT INTO $table (title, content) VALUES (:title, :content)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        return $stmt->execute();
    }

    // Read content
    public function getContent($table) {
        $query = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update existing content
    public function updateContent($table, $data, $id) {
        $query = "UPDATE $table SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Delete content
    public function deleteContent($table, $id) {
        $query = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    
</body>
</html>