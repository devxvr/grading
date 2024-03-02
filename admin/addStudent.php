<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Student';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Student</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Add New Student</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                       
                                        <form method="Post" action="">
                                            <div class="row mb-3">
                                                
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">LRN Number: </label>
                                                        <input id="" name="lid" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Last Name:</label>
                                                        <input id="last" name="lname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name:</label>
                                                        <input id="first" name="fname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Middle Name:</label>
                                                        <input id="middle" name="mname" type="tel" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Suffix:</label>
                                                        <input id="suffix" name="sname" type="tel" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                
                                                        <!-- TRY LANG
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Position:</label>
                                                        <input id="" name="designation" type="tel" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>-->
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Sex:</label>
                                                            <select  name="designation" id="designation" class="form-select">
                                                                <option value="">Select Sex</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Birtdate:</label>
                                                        <input id="bday" name="bday" type="date" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Address:</label>
                                                        <input id="address" name="address" type="tel" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Contact Number:</label>
                                                        <input id="contactnumber" name="contactnumber" type="number" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
</div>
</div>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary me-md-2" type="button">Add</button>
  <button class="btn btn-danger" type="button">Cancel</button>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>