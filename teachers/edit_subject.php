<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

require_once './subject_class.php';
require_once './manage_subject.php';


// Define the validate_field function
function validate_field($field){
    // Your validation logic goes here
    return !empty($field);
}

if(isset($_GET['id'])){
    $subject = new subjects();
    $record = $subject->get_component($_GET['id']);
    $subject->name = $record['name'];
}

if(isset($_POST['save'])){
    $subject = new subjects();
    $subject->subject_id = $_GET['id'];
    //sanitize
    $subject->name = htmlentities($_POST['name']);

    // Perform validation
    if (validate_field($subject->name)) {
        // Proceed with saving changes
        if($subject->edit()){
            header('location: maintenance.php');
            exit;
        } else {
            echo 'An error occurred while adding in the database.';
        }
    } else {
        echo 'Field validation failed.';
    }
}
?>
<div class="container-fluid">
    <form action="" id="subject-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($subject_id) ? $subject_id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Subject Name</label>
            <input type="text" name="name" autofocus id="name" required class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="button-group">
            <button type="submit" name="save" class="btn btn-primary mt-2 mb-3 brand-bg-color" id="addStaffButton">Save Changes</button>
        </div>
    </form>
</div>

