<?php

function validate_field($value) {
   
    if(empty($value)) {
        return false; 
    } else {
        return true; 
    }
}


require_once '../classes/faculty-class.php';
if(isset($_POST['save'])){
    $faculty = new faculty();
    $faculty->lastname = htmlentities($_POST['lastname']);
    $faculty->firstname = htmlentities($_POST['firstname']);
    $faculty->middlename = htmlentities($_POST['middlename']);
    $faculty->employee_id = htmlentities($_POST['employee_id']);
    $faculty->teacher_position = htmlentities($_POST['teacher_position']);
    
    // Validate the fields
    if (validate_field($faculty->lastname) && 
        validate_field($faculty->firstname) &&
        validate_field($faculty->employee_id) &&  
        validate_field($faculty->teacher_position)){
        if($faculty->add()){
            header('location: admin-staff.php');
        } else {
            echo 'An error occurred while adding in the database.';
        }
    } else {
        echo 'Please fill in all required fields.';
    }
}
?>
<?php
    $title = 'Faculty';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Faculty</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Add New Faculty</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                       
                                        <form method="Post" action="">
                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Last Name:</label>
                                                        <input id="last" name="lastname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name:</label>
                                                        <input id="first" name="firstname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Middle Name:</label>
                                                        <input id="middle" name="middlename" type="tel" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Employee ID:</label>
                                                        <input id="" name="employee_id" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Position:</label>
                                                            <select  name="teacher_position" id="designation" class="form-select">
                                                                <option value="">Select Position</option>
                                                                <option value="Instructor I">Instructor I</option>
                                                                <option value="Instructor II">Instructor II</option>
                                                                <option value="Instructor III">Instructor III</option>
                                                                <option value="Master Teacher I">Master Teacher I</option>
                                                                <option value="Master Teacher II">Master Teacher II</option>
                                                                <option value="Master Teacher III">Master Teacher III</option>
                                                                <option value="Special Education Teacher I">Special Education Teacher I</option>
                                                                <option value="Special Education Teacher II">Special Education Teacher II</option>
                                                                <option value="Special Education Teacher III">Special Education Teacher III</option>
                                                                <option value="Special Education Teacher III">Special Education Teacher III</option>
                                                                <option value="Teacher I">Teacher I</option>
                                                                <option value="Teacher II">Teacher II</option>
                                                                <option value="Teacher III">Teacher III</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
</div>
</div>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary me-md-2" type="submit" name="save">Add</button>
  <button class="btn btn-danger" type="button">Cancel</button>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>