<?php

require_once '../includes/database.php';

class Account{

    public $id;
    public $email;
    public $password;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function sign_in_admin(){
        $sql = "SELECT * FROM admin_list WHERE email = :email";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
    
        if ($query->execute()) {
            $accountData = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($accountData && password_verify($this->password, $accountData['password'])) {
                $this->id = $accountData['id'];
                return true;
            }
        }
    
        return false;
    }
    

    function sign_in_teacher(){
        $sql = "SELECT * FROM teacher WHERE email = :email LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
    
        if ($query->execute()) {
            $accountData = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($accountData && password_verify($this->password, $accountData['password'])) {
                $this->id = $accountData['id'];
                return true;
            }
        }
    
        return false;
    } 

    

}

?>