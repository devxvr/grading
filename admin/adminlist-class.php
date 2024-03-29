<?php

require_once '../includes/database.php';

Class admin_list{
    //attributes

    public $admin_id;
    public $firstname;
    public $lastname;
    public $middlename;
    public $email;
    
    public $password;
    

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO admin_list (firstname, lastname, middlename, email, password) VALUES 
                (:firstname, :lastname, :middlename, :email, :password)";
    
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':email', $this->email);
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
        $sql = "UPDATE admin_list SET firstname=:firstname, lastname=:lastname, middlename=:middlename, email=:email WHERE admin_id = :admin_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':admin_id', $this->admin_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM admin_list WHERE admin_id = :admin_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':admin_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM admin_list ORDER BY lastname ASC, firstname ASC;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function is_email_exist(){
        $sql = "SELECT * FROM admin_list WHERE email = :email;";
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
        $sql = "DELETE FROM admin_list WHERE admin_id = :admin_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':admin_id', $staffId);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    

}

?>