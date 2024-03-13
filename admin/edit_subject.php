

<?php
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


<?php
    $title = 'Calendar';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Edit Subject</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div  div class="card-body">
            
        <div class="container-fluid">
    <form action="" id="subject-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($subject_id) ? $subject_id : '' ?>">
        <div class="col-4 form-group">
            <label for="name" class="control-label">Subject Name</label>
            <input type="text" name="name" autofocus id="name" required class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="button-group">
            <button type="submit" name="save" class="btn btn-primary mt-3 mb-2 brand-bg-color" id="addStaffButton">Save Changes</button>
        </div>
    </form>
</div>
        </div>
    </div>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>