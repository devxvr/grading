<?php

require_once '../includes/database.php';

Class faculty{
    //attributes

    public $faculty_id;
    public $firstname;
    public $middlename;
    public $lastname;
    public $employee_id;
    public $teacher_position;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add() {
        $sql = "INSERT INTO faculty (firstname, middlename, lastname, teacher_position, employee_id) VALUES 
        (:firstname, :middlename, :lastname, :teacher_position, :employee_id)";
    
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':teacher_position', $this->teacher_position);
        $query->bindParam(':employee_id', $this->employee_id); 

        
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }   
    }

    function edit(){
        $sql = "UPDATE faculty SET firstname=:firstname, middlename=:middlename, lastname=:lastname, teacher_position=:teacher_position, employee_id=:employee_id WHERE faculty_id = :faculty_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':teacher_position', $this->teacher_position);
        $query->bindParam(':employee_id', $this->employee_id);
        $query->bindParam(':faculty_id', $this->faculty_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM faculty WHERE faculty_id = :faculty_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':faculty_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM faculty ORDER BY lastname ASC, firstname ASC, suffix ASC;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete($studentId){
        $sql = "DELETE FROM faculty WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $studentId);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    

}

?>