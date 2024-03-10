<?php

require_once './includes/database.php';

class grading_components {
    //attributes
    public $component_id;
    public $name;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    // Method to fetch component details from the database based on component_id
    function get_component($component_id) {
        $query = "SELECT * FROM grading_components WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $component_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to edit component details in the database
    public function edit() {
        $query = "UPDATE grading_components SET name = :name WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $this->component_id);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    // Method to delete a component
    public function delete($component_id) {
        $query = "DELETE FROM grading_components WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $component_id);
        return $stmt->execute();
    }
}

?>
