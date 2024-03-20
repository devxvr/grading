<?php
session_start();

if (isset($_SESSION['teachers_list']) && $_SESSION['teachers_list'] == 'teacher_list') {
    header('location: ./login.php');
    exit(); 
    
require_once './section-class.php';


function validate_field($value) {
    return !empty($value);
}

if(isset($_POST['save'])){
    
    $sectionObj = new Section();

    
    $sectionObj->section = htmlentities($_POST['section']);
    $sectionObj->gradelvl = htmlentities($_POST['gradelvl']);

    
    if (validate_field($sectionObj->section) && validate_field($sectionObj->gradelvl)) {
        
        if($sectionObj->add()){
            
            header('location: class.php');
            exit();
        } else {
            echo 'An error occurred while adding in the database.';
        }
    } else {
        echo 'Please fill in all required fields.';
    }
}
?>

<?php
$title = 'Section';
require_once '../includes/head.php';
?>

<body>
<?php
require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Section</h2>
        </div>
    </div>
    <div class="card mb-3 mt-4">
        <div class="card-header">
            <strong class="card-title"><h2 align="center">Add New Section</h2></strong>
        </div>
        <div class="card-body">
            <form method="Post" action="">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cc-exp" class="control-label mb-1">Grade Level:</label>
                            <select name="gradelvl" id="designation" class="form-select">
                                <option value="">Select Grade Level</option>
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cc-exp" class="control-label mb-1">Section:</label>
                            <input id="section" name="section" type="tel" class="form-control cc-exp" value="" placeholder="">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary me-md-2" type="submit" name="save">Add</button>
        <button class="btn btn-danger" type="button">Cancel</button>
    </div>
</div>
</body>

<?php
require_once('../includes/script.js.php');
?>
</html>
