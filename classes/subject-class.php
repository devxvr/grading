<?php

require_once '../includes/database.php';

Class subject{
    //attributes

    public $subject_id;
    public $subject_title;
    public $gradelvl;
    

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add() {
        $sql = "INSERT INTO subject (subject_title, gradelvl) VALUES 
        (:subject_title, :gradelvl)";
    
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':subject_title', $this->subject_title);
        $query->bindParam(':gradelvl', $this->gradelvl);
        
        
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }   
    }

    function edit(){
        $sql = "UPDATE subject SET subject_title=:subject_title, gradelvl=:gradelvl WHERE subject_id = :subject_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':subject_title', $this->subject_title);
        $query->bindParam(':gradelvl', $this->gradelvl);
        $query->bindParam(':subject_id', $this->subject_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM subject WHERE subject_id = :subject_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':subject_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM subject ORDER BY subject_title ASC;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete($studentId){
        $sql = "DELETE FROM subject WHERE subject_id = :subject_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':subject_id', $studentId);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    

}

?>