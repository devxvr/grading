<?php

require_once '../includes/database.php';

class admin_list {
    //attributes
    public $admin_id;
    public $fullname;
    public $username;
    public $password;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function add(){
        $sql = "INSERT INTO admin_list (fullname, username, password) VALUES (:admin_list, :username, :password);";


        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':fullname', $this->fullname);
        $query->bindParam(':username', $this->username);
        
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }   
    }

    public function edit(){
        if(!isset($this->admin_id)) {
            return false; 
        }
        $sql = "UPDATE admin_list SET admin_list = :admin_list, username = :username WHERE admin_id = :admin_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':admin_list', $this->admin_list);
        $query->bindParam(':username', $this->username);
        $query->bindParam(':admin_id', $this->admin_id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function show() {
        try {
            $sections = array();
            $sql = "SELECT * FROM admin_list"; 
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
    

    // Method to check if a admin_list exists
    public function isSectionExists($admin_id) {
        $sql = "SELECT COUNT(*) FROM admin_list WHERE admin_id = :admin_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':admin_id', $admin_id);
        $query->execute();
        $count = $query->fetchColumn();
        return $count > 0;
    }

    // Method to fetch all grades
    function fetchAllGrades() {
        $grades = [];
        $sql = "SELECT DISTINCT username FROM admin_list";
        $query = $this->db->connect()->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $grades[] = $row['username'];
        }
        return $grades;
    }

    // Method to fetch all sections
    function fetchAllSections() {
        $sections = [];
        $sql = "SELECT DISTINCT admin_list FROM admin_list";
        $query = $this->db->connect()->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $sections[] = $row['admin_list'];
        }
        return $sections;
    }

    function fetchAllSectionsAndGrades() {
        $sectionData = [];
        try {
            
            $sql = "SELECT admin_list, username FROM admin_list ORDER BY username, admin_list";
            $query = $this->db->connect()->query($sql);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $sectionData[] = $row; 
            }
        } catch (PDOException $e) {
            
            error_log("Error fetching sections and grades: " . $e->getMessage());
        }
        return $sectionData;
    }
    
    public function getSectionById($admin_id) {
        try {
            $sql = "SELECT * FROM admin_list WHERE admin_id = :admin_id";
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':admin_id', $admin_id);
            $query->execute();
            $sectionDetails = $query->fetch(PDO::FETCH_ASSOC);
            return $sectionDetails;
        } catch (PDOException $e) {
            
            error_log("Error fetching admin_list by ID: " . $e->getMessage());
            return false;
        }
    }

    public function delete($admin_id) {
        try {
            $sql = "DELETE FROM admin_list WHERE admin_id = :admin_id";
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':admin_id', $admin_id);
            return $query->execute();
        } catch (PDOException $e) {
            
            error_log("Error deleting admin_list: " . $e->getMessage());
            return false;
        }
    }
    
    
}
?>
