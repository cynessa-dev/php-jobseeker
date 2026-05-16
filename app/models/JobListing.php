<?php

class JobListing {
    private $user_id;
    private $title;
    private $description;
    private $salary;
    private $tags;
    private $company;
    private $address;
    private $city;
    private $state;
    private $phone;
    private $email;
    private $requirements;
    private $benefits;

    public function __construct($user_id, $title, $description, $salary, $tags, $company, $address, $city, $state, $phone, $email, $requirements, $benefits) {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->salary = $salary;
        $this->tags = $tags;
        $this->company = $company;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->phone = $phone;
        $this->email = $email;
        $this->requirements = $requirements;
        $this->benefits = $benefits;
    }

    public function save() {
        $config = require basePath('config/db.php');
        $db = new Database($config);

        $query = "INSERT INTO listings (user_id, title, description, salary, tags, company, address, city, state, phone, email, requirements, benefits) VALUES (:user_id, :title, :description, :salary, :tags, :company, :address, :city, :state, :phone, :email, :requirements, :benefits)";

        $stmt = $db->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':salary', $this->salary);
        $stmt->bindParam(':tags', $this->tags);
        $stmt->bindParam(':company', $this->company);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':requirements', $this->requirements);
        $stmt->bindParam(':benefits', $this->benefits);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Failed to save job listing: " . $e->getMessage());
        }
    }
}

?>