<?php

require_once '../includes/database.php';

Class class_list{
    //attributes

    public $class_id;
    public $grade;
    public $section;
    
    

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
    $sql = "INSERT INTO class_list (subject_id, grade, section) VALUES (:subject_id, :grade, :section)";

    $query = $this->db->connect()->prepare($sql);
    $query->bindParam(':subject_id', $this->subject_id);
    $query->bindParam(':grade', $this->grade);
    $query->bindParam(':section', $this->section);

    if($query->execute()){
        return true;
    } else {
        return false;
    }
}

    

    function edit(){
        $sql = "UPDATE class_list SET grade=:grade, section=:section WHERE class_id = :class_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':grade', $this->grade);
        $query->bindParam(':section', $this->section);
        $query->bindParam(':class_id', $this->class_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM class_list WHERE class_id = :class_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':class_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM class_list;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    
    function delete($class_id){
        $sql = "DELETE FROM class_list WHERE class_id = :class_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':class_id', $class_id);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    
        public function fetchMarks($class_id, $section, $assessment_id) {
            $results = [];
            try {
                // Correctly use the database connection as per your class setup
                $query = "SELECT ml.*, s.firstname, s.lastname FROM mark_list ml 
                          INNER JOIN student s ON ml.student_id = s.id 
                          WHERE ml.class_id = :class_id 
                          AND s.section = :section 
                          AND ml.assessment_id = :assessment_id";
                $stmt = $this->db->connect()->prepare($query);
                $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
                $stmt->bindParam(':section', $section, PDO::PARAM_STR);
                $stmt->bindParam(':assessment_id', $assessment_id, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Log or handle the error as appropriate for your application
                error_log("Error fetching marks: " . $e->getMessage());
            }
            return $results;
        }
    }
    

?>