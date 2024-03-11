<?php
    require_once '../includes/database.php';
    
    class component_subject_percentage{
    //attributes
    public $subject_id;
    public $component_id;
    public $csp_id;
    public $percentage;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    
    function get_component($component_id) {
        $query = "SELECT * FROM component_subject_percentage WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $component_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function edit() {
        $query = "UPDATE component_subject_percentage SET name = :name WHERE component_id = :component_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':component_id', $this->component_id);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }
    

    
}
?>