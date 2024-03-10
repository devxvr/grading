<?php

require_once './includes/database.php';

class subjects {
    //attributes
    public $subject_id;
    public $name;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    // Method to fetch component details from the database based on subject_id
    function get_component($subject_id) {
        $query = "SELECT * FROM subjects WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to edit component details in the database
    public function edit() {
        $query = "UPDATE subjects SET name = :name WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $this->subject_id);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    // Method to delete a component
    public function delete($subject_id) {
        $query = "DELETE FROM subjects WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        return $stmt->execute();
    }
}

?>
