<?php


function validate_field($value) {
   
    if(empty($value)) {
        return false; 
    } else {
        return true; 
    }
}


require_once '../classes/subject-class.php';
if(isset($_POST['save'])){
    $subjects = new subject();
    $subjects->subject_title = htmlentities($_POST['subject_title']);
    $subjects->gradelvl = htmlentities($_POST['gradelvl']);
    
    // Validate the fields
    if (validate_field($subjects->subject_title) && validate_field($subjects->gradelvl)){
        if($subjects->add()){
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
    $title = 'Subject';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">

            

            <h2>Subject</h2>

        </div>
    </div>
        <div class="card mb-3 mt-4">
            <div class="card-header">
                <strong class="card-title"><h2 align="center">Add New Subject</h2></strong>
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
                                         <label for="cc-exp" class="control-label mb-1">Subject Title:</label>
                                          <input id="subject" name="subject_title" type="tel" class="form-control cc-exp" value="" placeholder="">
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