<?php

require_once '../includes/database.php';

Class teacher_list{
    //attributes

    public $teacher_id;
    public $firstname;
    public $lastname;
    public $middlename;
    public $email;
    public $department;
    public $gender;
    public $contact;
    public $password;
    

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO teacher_list (firstname, lastname, middlename, email, department, gender, contact, password) VALUES 
                (:firstname, :lastname, :middlename, :email, :department, :gender, :contact, :password)";
    
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':department', $this->department);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':contact', $this->contact);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
    
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }   
    }
    

    function edit(){
        $sql = "UPDATE teacher_list SET firstname=:firstname, lastname=:lastname, middlename=:middlename, email=:email, department=:department, gender=:gender, contact=:contact WHERE teacher_id = :teacher_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':department', $this->department);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':contact', $this->contact);
        $query->bindParam(':teacher_id', $this->teacher_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM teacher_list WHERE teacher_id = :teacher_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':teacher_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM teacher_list ORDER BY lastname ASC, firstname ASC;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function is_email_exist(){
        $sql = "SELECT * FROM teacher_list WHERE email = :email;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        if($query->execute()){
            if($query->rowCount()>0){
                return true;
            }
        }
        return false;
    }
    function delete($staffId){
        $sql = "DELETE FROM teacher_list WHERE teacher_id = :teacher_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':teacher_id', $staffId);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    

}

?>