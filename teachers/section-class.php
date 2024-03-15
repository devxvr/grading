<?php

require_once '../includes/database.php';

class Section {
    //attributes
    public $section_id;
    public $section;
    public $gradelvl;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function add(){
        $sql = "INSERT INTO section (section, gradelvl) VALUES (:section, :gradelvl);";


        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':section', $this->section);
        $query->bindParam(':gradelvl', $this->gradelvl);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }   
    }

    public function edit(){
        if(!isset($this->section_id)) {
            return false; 
        }
        $sql = "UPDATE section SET section = :section, gradelvl = :gradelvl WHERE section_id = :section_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':section', $this->section);
        $query->bindParam(':gradelvl', $this->gradelvl);
        $query->bindParam(':section_id', $this->section_id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function show() {
        try {
            $sections = array();
            $sql = "SELECT * FROM section"; 
            $query = $this->db->connect()->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $sections[] = $row;
            }
            return $sections;
        } catch (PDOException $e) {
            
            error_log("Error fetching sections: " . $e->getMessage());
            return false;
        }
    }
    

    // Method to check if a section exists
    public function isSectionExists($section_id) {
        $sql = "SELECT COUNT(*) FROM section WHERE section_id = :section_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':section_id', $section_id);
        $query->execute();
        $count = $query->fetchColumn();
        return $count > 0;
    }

    // Method to fetch all grades
    function fetchAllGrades() {
        $grades = [];
        $sql = "SELECT DISTINCT grade FROM class_list"; 
        $query = $this->db->connect()->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $grades[] = $row['grade'];
        }
        return $grades;
    }

    function fetchAllSections() {
        $sections = [];
        $sql = "SELECT DISTINCT section FROM class_list"; 
        $query = $this->db->connect()->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $sections[] = $row['section'];
        }
        return $sections;
    }

    function fetchAllGradesFromSectionTable() {
        $grades = [];
        try {
            $sql = "SELECT DISTINCT gradelvl FROM section";
            $query = $this->db->connect()->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $grades[] = $row['gradelvl']; 
            }
        } catch (PDOException $e) {
            
            error_log("Error fetching grades: " . $e->getMessage());
        }
        return $grades;
    }

  
    function fetchAllSectionsFromSectionTable() {
        $sections = [];
        try {
            $sql = "SELECT DISTINCT section FROM section";
            $query = $this->db->connect()->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $sections[] = $row['section'];
            }
        } catch (PDOException $e) {
            
            error_log("Error fetching sections: " . $e->getMessage());
        }
        return $sections;
    }

    function fetchAllSectionsAndGrades() {
        $sectionData = [];
        try {
            
            $sql = "SELECT section, gradelvl FROM section ORDER BY gradelvl, section";
            $query = $this->db->connect()->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $sectionData[] = $row; 
            }
        } catch (PDOException $e) {
            
            error_log("Error fetching sections and grades: " . $e->getMessage());
        }
        return $sectionData;
    }
    
    public function getSectionById($section_id) {
        try {
            $sql = "SELECT * FROM section WHERE section_id = :section_id";
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':section_id', $section_id);
            $query->execute();
            $sectionDetails = $query->fetch(PDO::FETCH_ASSOC);
            return $sectionDetails;
        } catch (PDOException $e) {
            
            error_log("Error fetching section by ID: " . $e->getMessage());
            return false;
        }
    }

    public function delete($section_id) {
        try {
            $sql = "DELETE FROM section WHERE section_id = :section_id";
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':section_id', $section_id);
            return $query->execute();
        } catch (PDOException $e) {
            
            error_log("Error deleting section: " . $e->getMessage());
            return false;
        }
    }
    
    
}
?>
