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

    function get_component($component_id) {
        $query = "SELECT * FROM grading_components WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $component_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function edit() {
        $query = "UPDATE grading_components SET name = :name WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $this->component_id);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    
    public function delete($component_id) {
        $query = "DELETE FROM grading_components WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $component_id);
        return $stmt->execute();
    }
}

?>
