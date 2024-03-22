<?php

session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

require_once '../includes/database.php';

class Component_Subject_Percentage {
    //attributes
    public $subject_id;
    public $component_id;
    public $percentage;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    public function insertPercentage() {
        try {
            $query = "INSERT INTO component_subject_percentage (subject_id, component_id, percentage) VALUES (:subject_id, :component_id, :percentage)";
            $stmt = $this->db->connect()->prepare($query);
            $stmt->bindParam(':subject_id', $this->subject_id);
            $stmt->bindParam(':component_id', $this->component_id);
            $stmt->bindParam(':percentage', $this->percentage);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle any potential errors here
            return false;
        }
    }
}
?>
