<?php

require_once '../includes/database.php';

Class admin_list{
    //attributes

    public $admin_id;
    public $fullname;
    public $username;
    public $password;
    

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO admin_list (fullname, username, password) VALUES 
        (:fullname, :username, :password);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':fullname', $this->fullname);
        $query->bindParam(':username', $this->username);
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
        $sql = "UPDATE admin_list SET fullname=:fullname, username=:username, password=:password WHERE id = :id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':fullname', $this->fullname);
        $query->bindParam(':username', $this->username);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':id', $this->id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM admin_list WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM admin_list ORDER BY username ASC, fullname ASC;";
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
        $sql = "DELETE FROM admin_list WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $staffId);
    
        if($query->execute()){
            return true;
        } else {
            return false;   
        }
    }
    

}

?>