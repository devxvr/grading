<?php
    require_once '../classes/student-class.php';
    require_once '../classes/functions.php';
    
    
    

    if(isset($_POST['save'])){

        $student = new student();
        //sanitize
        
        $student->firstname = htmlentities($_POST['firstname']);
        $student->middlename = htmlentities($_POST['middlename']);
        $student->lastname = htmlentities($_POST['lastname']);
        $student->suffix = htmlentities($_POST['suffix']);
        $student->birthday = htmlentities($_POST['birthday']);
        $student->address = htmlentities($_POST['address']);
        $student->contact = htmlentities($_POST['contact']);
        $student->LRN = htmlentities($_POST['LRN']);
        $student->sex = htmlentities($_POST['sex']);
        
        

        //validate
        if (validate_field($student->firstname) &&
            validate_field($student->lastname) &&
            validate_field($student->birthday) &&
            validate_field($student->address) &&
            validate_field($student->contact) &&
            validate_field($student->LRN) &&
            validate_field($student->sex)) {

            // If all required fields are present, attempt to add the student
            if($student->add()){
                header('location: viewStudent.php');
                exit(); // Exit script after redirect
            } else {
                echo 'An error occurred while adding to the database.';
            }
        } else {
            echo 'All required fields must be filled.';
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Student';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.php');
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
                                                        <input id="" name="LRN" type="tel" class="form-control cc-exp"  Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" value="<?php if(isset($_POST['LRN'])) { echo $_POST['LRN']; } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Last Name:</label>
                                                        <input id="last" name="lastname" type="tel" class="form-control cc-exp"  Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder=""value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>">
                                                        <?php
                                                                if(isset($_POST['lastname']) && !validate_field($_POST['lastname'])){
                                                            ?>
                                                        <p class="text-danger my-1">Last name is required</p>
                                                        <?php
                                                                }
                                                            ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">First Name:</label>
                                                        <input id="first" name="firstname" type="tel" class="form-control cc-exp"  Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>">
                                                        <?php
                                                                if(isset($_POST['firstname']) && !validate_field($_POST['firstname'])){
                                                            ?>
                                                        <p class="text-danger my-1">First name is required</p>
                                                        <?php
                                                                }
                                                            ?>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Middle Name:</label>
                                                        <input id="middle" name="middlename" type="tel" class="form-control cc-exp"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Suffix:</label>
                                                        <input id="suffix" name="suffix" type="tel" class="form-control cc-exp"  placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Sex:</label>
                                                        <select name="sex" id="sex" class="form-select">
                                                        <option value="">Select a gender</option>
                                                        <?php echo getGenderOptions(isset($_POST['gender']) ? $_POST['gender'] : null); ?>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Birtdate:</label>
                                                        <input id="bday" name="birthday" type="date" class="form-control cc-exp" value="" placeholder="" value="<?php if(isset($_POST['birthday'])) { echo $_POST['birthday']; } ?>">
                                                        <?php
                                                                if(isset($_POST['birthday']) && !validate_field($_POST['birthday'])){
                                                            ?>
                                                        <p class="text-danger my-1">Birthday is required</p>
                                                        <?php
                                                                }
                                                            ?>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Address:</label>
                                                        <input id="address" name="address" type="tel" class="form-control cc-exp" placeholder=""value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>">
                                                        <?php
                                                                if(isset($_POST['address']) && !validate_field($_POST['address'])){
                                                            ?>
                                                        <p class="text-danger my-1">Birthday is required</p>
                                                        <?php
                                                                }
                                                            ?>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Contact Number:</label>
                                                        <input id="contactnumber" name="contact" type="number" class="form-control cc-exp" placeholder="" value="<?php if(isset($_POST['contact'])) { echo $_POST['contact']; } ?>">
                                                        <?php
                                                                if(isset($_POST['contact']) && !validate_field($_POST['contact'])){
                                                            ?>
                                                        <p class="text-danger my-1">Contact Number is required</p>
                                                        <?php
                                                                }
                                                            ?>
                                                    </div>
                                                    
                                                </div>
                                               </div>
                            </div>
                            
        <div  div class="card-body">
            
        <h3>Secondary Details</h3> <hr color="black">
                                        <div class="row">                       
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Father's Name</label>
                                                    <input id="father" name="father" type="text" class="form-control cc-exp" value="<?= isset($_POST['father']) ? $_POST['father'] : ''; ?>"  placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Contact Number</label>
                                                    <input id="fathernum" name="fathernum" type="phone" maxlength="11" minlength="11" class="form-control cc-exp" value="<?= isset($_POST['fathernum']) ? $_POST['fathernum'] : ''; ?>"   placeholder="">
                                                    </div>
                                                </div>
                                        </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Mother's Name</label>
                                                    <input id="mother" name="mother" type="text" class="form-control cc-exp" value="<?= isset($_POST['mother']) ? $_POST['mother'] : ''; ?>"   placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Contact Number</label>
                                                    <input id="mothernum" name="mothernum" type="phone" maxlength="11" minlength="11" class="form-control cc-exp" value="<?= isset($_POST['mothernum']) ? $_POST['mothernum'] : ''; ?>"  placeholder="">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Guardian's Name <span style="color:red;">*</span></label>
                                                <input id="guardian" name="guardian" type="text" class="form-control cc-exp" value="<?= isset($_POST['guardian']) ? $_POST['guardian'] : ''; ?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-exp="Please enter a valid security code" placeholder="">
                                                </div>
                                            </div>  
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="x_card_code" class="control-label mb-1">Contact Number <span style="color:red;">*</span></label>
                                                <input id="guardiannum" name="guardiannum" type="phone" maxlength="11" minlength="11" class="form-control cc-exp" value="<?= isset($_POST['guardiannum']) ? $_POST['guardiannum'] : ''; ?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-exp="Please enter a valid security code" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                        <div>
                                            <button type="submit" name="submit" class="btn btn-primary mt-3">Add New Student</button>
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