<?php

require_once '../includes/database.php';

class section {
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
}
   ?>