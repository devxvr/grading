<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}
require_once '../includes/database.php';

Class assessment_list {
    //attributes
    public $assessment_id;
    public $class_id;
    public $component_id;
    public $quarter;
    public $name;
    public $hps;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    //Methods

    function add() {
        // Check if class_id exists in class_list table
        $classCheckSql = "SELECT * FROM class_list WHERE class_id = :class_id";
        $classCheckQuery = $this->db->connect()->prepare($classCheckSql);
        $classCheckQuery->bindParam(':class_id', $this->class_id);
        $classCheckQuery->execute();
        $classExists = $classCheckQuery->fetch();

        if (!$classExists) {
            // Class ID does not exist in class_list table
            return false;
        }

        // Proceed with the insertion
        $sql = "INSERT INTO assessment_list (class_id, component_id, quarter, name, hps) VALUES 
        (:class_id, :component_id, :quarter, :name, :hps)";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':class_id', $this->class_id);
        $query->bindParam(':component_id', $this->component_id);
        $query->bindParam(':quarter', $this->quarter);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':hps', $this->hps);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit() {
        $sql = "UPDATE assessment_list SET quarter=:quarter, name=:name WHERE assessment_id = :assessment_id;";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':quarter', $this->quarter);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':assessment_id', $this->assessment_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetch($record_id) {
        $sql = "SELECT * FROM assessment_list WHERE assessment_id = :assessment_id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':assessment_id', $record_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data ? $data : [];
    }
    

    function show() {
        $sql = "SELECT * FROM assessment_list;";
        $query = $this->db->connect()->prepare($sql);
        $data = null;
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete($assessment_id) {
        $sql = "DELETE FROM assessment_list WHERE assessment_id = :assessment_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':assessment_id', $assessment_id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
}

?>
