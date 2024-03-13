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
                                                        <input id="last" name="lname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name:</label>
                                                        <input id="first" name="fname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Middle Name:</label>
                                                        <input id="middle" name="mname" type="tel" class="form-control cc-exp" value="" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Employee ID:</label>
                                                        <input id="" name="fid" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Position:</label>
                                                            <select  name="designation" id="designation" class="form-select">
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
  <button class="btn btn-primary me-md-2" type="button">Add</button>
  <button class="btn btn-danger" type="button">Cancel</button>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>