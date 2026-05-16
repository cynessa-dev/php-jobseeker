<?php

class JobListing {
    private array $data;

    private static array $fields = [
        'user_id', 'title', 'description', 'salary', 'tags',
        'company', 'address', 'city', 'state', 'phone',
        'email', 'requirements', 'benefits'
    ];

    public function __construct(array $data) {
        // Only keep recognized fields to prevent mass assignment vulnerabilities
        $this->data = array_intersect_key($data, array_flip(self::$fields));
    }

    public function save(): bool {
        $config = require basePath('config/db.php');
        $db = new Database($config);

        $columns = implode(', ', self::$fields);
        $placeholders = implode(', ', array_map(fn($f) => ":$f", self::$fields));

        $query = "INSERT INTO listings ($columns) VALUES ($placeholders)";
        $stmt = $db->conn->prepare($query);

        foreach (self::$fields as $field) {
            $stmt->bindParam(":$field", $this->data[$field]);
        }

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Failed to save job listing: " . $e->getMessage());
        }
    }
}