<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

require_once '../includes/database.php';

class subjects {
    //attributes
    public $subject_id;
    public $name;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    public function show() {
        try {
            $subjects = array();
            $sql = "SELECT * FROM subjects";
            $query = $this->db->connect()->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $subjects[] = $row;
            }
            return $subjects;
        } catch (PDOException $e) {
            
            error_log("Error fetching subjects: " . $e->getMessage());
            return false;
        }
    }
    

    
    function get_component($subject_id) {
        $query = "SELECT * FROM subjects WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function edit() {
        $query = "UPDATE subjects SET name = :name WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $this->subject_id);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

   
    
    public function delete($subject_id) {
        $query = "DELETE FROM subjects WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        return $stmt->execute();
    }

    // Method to check if a subject exists
    public function isSubjectExists($subject_id) {
        $query = "SELECT COUNT(*) FROM subjects WHERE subject_id = :subject_id";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}

?>
