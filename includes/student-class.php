<?php

require_once '../includes/database.php';

class Student {
    // Attributes
    public $id;
    public $firstname;
    public $middlename;
    public $lastname;
    public $suffix;
    public $sex;
    public $contact;
    public $birthday;
    public $address;
    public $LRN;
    public $father;
    public $mother;
    public $guardian;
    public $fathernum;
    public $mothernum;
    public $guardiannum;

    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Methods
    public function add() {
        $sql = "INSERT INTO student (firstname, middlename, lastname, suffix, sex, birthday, address, contact, LRN) VALUES (:firstname, :middlename, :lastname, :suffix, :sex, :birthday, :address, :contact, :LRN)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':suffix', $this->suffix);
        $query->bindParam(':sex', $this->sex);
        $query->bindParam(':birthday', $this->birthday);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':contact', $this->contact); 
        $query->bindParam(':LRN', $this->LRN);
        
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function edit() {
        $sql = "UPDATE student SET firstname=:firstname, middlename=:middlename, lastname=:lastname, suffix=:suffix, sex=:sex, birthday=:birthday, address=:address, contact=:contact WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':middlename', $this->middlename);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':suffix', $this->suffix);
        $query->bindParam(':sex', $this->sex);
        $query->bindParam(':birthday', $this->birthday);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':contact', $this->contact);
        $query->bindParam(':id', $this->id);
        
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch($record_id) {
        $sql = "SELECT * FROM student WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if ($query->execute()) {
            $data = $query->fetch();
            return $data;
        } else {
            return null;
        }
    }

    public function show() {
        $sql = "SELECT * FROM student ORDER BY lastname ASC, firstname ASC, suffix ASC";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $data = $query->fetchAll();
            return $data;
        } else {
            return null;
        }
    }

    public function delete($studentId) {
        $sql = "DELETE FROM student WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $studentId);
    
        if ($query->execute()) {
            return true;
        } else {
            return false;   
        }
    }

    public function fetchAllStudents() {
        $sql = "SELECT * FROM student ORDER BY lastname ASC, firstname ASC, suffix ASC";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $students = $query->fetchAll();
            return $students;
        } else {
            return null;
        }
    }
}

?>
