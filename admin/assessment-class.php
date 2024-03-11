<?php

require_once '../includes/database.php';

Class assessment_list{
    //attributes

    public $assessment_id;
    public $class_id;
    public $component_id;
    public $quarter;
    public $name;
    public $hps;
    
    

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
       
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
        $sql = "INSERT INTO assessment_list (class_id,component_id, quarter, name, hps) VALUES 
        (:class_id, :component_id, :quarter, :name, :hps)";
    
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':class_id', $this->class_id);
        $query->bindParam(':component_id', $this->component_id);
        $query->bindParam(':quarter', $this->quarter);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':hps', $this->hps);
    
        if($query->execute()){
            return true;
        } else {
            return false;
        }   
    }
    
    
    

    function edit(){
        $sql = "UPDATE assessment_list SET quarter=:quarter, name=:name WHERE class_id = :class_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':quarter', $this->quarter);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':class_id', $this->class_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM assessment_list WHERE class_id = :class_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':class_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM assessment_list;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    
    function delete($class_id){
        $sql = "DELETE FROM assessment_list WHERE class_id = :class_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':class_id', $class_id);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    

}

?>