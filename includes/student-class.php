<?php
require_once 'database.php';

class Student {
    //attributes
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
    public $fathernum;
    public $mother;
    public $mothernum;
    public $guardian;
    public $guardiannum;
   
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    //Methods

    function add() {
        $sql = "INSERT INTO student (firstname, middlename, lastname, suffix, sex, birthday, address, contact, LRN, father, fathernum, mother, mothernum, guardian, guardiannum) VALUES 
        (:firstname, :middlename, :lastname, :suffix, :sex, :birthday, :address, :contact, :LRN, :mother, :mothernum, :father, :fathernum, :guardian, :guardiannum)";

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
        $query->bindParam(':father', $this->father);
        $query->bindParam(':fathernum', $this->fathernum);
        $query->bindParam(':mother', $this->mother);
        $query->bindParam(':mothernum', $this->mothernum);
        $query->bindParam(':guardian', $this->guardian);
        $query->bindParam(':guardiannum', $this->guardiannum);
        
        

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit() {
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
        $query->bindParam(':father', $this->father);
        $query->bindParam(':fathernum', $this->fathernum);
        $query->bindParam(':mother', $this->mother);
        $query->bindParam(':mothernum', $this->mothernum);
        $query->bindParam(':guardian', $this->guardian);
        $query->bindParam(':guardiannum', $this->guardiannum);
        $query->bindParam(':id', $this->id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetchAllStudents() {
        $students = [];
        $sql = "SELECT * FROM student";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $students[] = $row;
            }
        }
        return $students;
    }

}
?>
