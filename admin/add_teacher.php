<?php
    
    require_once './teacherlist-class.php';
    require_once  './functions.php';

    
    //  session_start();
     
    //  if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher'){
    //     header('location: ./login.php');
    //  }
    
    

    if(isset($_POST['save'])){

        $teacher = new teacher_list();
        //sanitize
        $teacher->firstname = htmlentities($_POST['firstname']);
        $teacher->middlename = htmlentities($_POST['middlename']);
        $teacher->lastname = htmlentities($_POST['lastname']);
        $teacher->email = htmlentities($_POST['email']);
        $teacher->password = htmlentities($_POST['password']);
        $teacher->department = htmlentities($_POST['department']);
        $teacher->gender = htmlentities($_POST['gender']);
        $teacher->contact = htmlentities($_POST['contact']);
        
        

        //validate
        if (validate_field($teacher->firstname) &&
        validate_field($teacher->lastname) &&
        validate_field($teacher->email) &&
        validate_field($teacher->department) &&
        validate_field($teacher->gender) &&
        validate_field($teacher->contact) &&
        validate_field($teacher->password) &&
        validate_password($teacher->password) &&
        validate_email($teacher->email) && !$teacher->is_email_exist()){
            if($teacher->add()){
                header('location: teacher-teacher.php');
            }else{
                echo 'An error occured while adding in the database.';
            }
        }
    }
?>
<?php
$title = 'teacher';
require_once '../includes/head.php';
?>

<body>
<?php
require_once('../includes/sidebar.admin.php');
?>  
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-12 col-lg-6 d-flex justify-content-between align-items-center">
            <h2 class="h3 brand-color pt-3 pb-2">Add teacher</h2>
            <a href="teacher.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left"
                    aria-hidden="true"></i> Back</a>
        </div>
        <div class="col-12 col-lg-6">
            <form method="post" action="">
                <div class="mb-2">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required
                        value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>">
                    <?php
                                    if(isset($_POST['firstname']) && !validate_field($_POST['firstname'])){
                                ?>
                    <p class="text-danger my-1">First name is required</p>
                    <?php
                                    }
                                ?>
                </div>
                <div class="mb-2">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" 
                        value="<?php if(isset($_POST['middlename'])) { echo $_POST['middlename']; } ?>">
                </div>
                <div class="mb-2">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required
                        value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>">
                    <?php
                                    if(isset($_POST['lastname']) && !validate_field($_POST['lastname'])){
                                ?>
                    <p class="text-danger my-1">Last name is required</p>
                    <?php
                                    }
                                ?>
                </div>
                <div class="mb-3" style="color: black;">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="form-group col-12 col-sm-auto flex-sm-grow-1 flex-lg-grow-0">
                                <select name="gender" id="gender" class="form-select me-md-2">
                                    <option value="">Select Option</option>
                                    <?php echo getGenderOptions(isset($_POST['gender']) ? $_POST['gender'] : null); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3" style="color: black;">
                            <label for="department" class="form-label">Select Department </label>
                            <div class="form-group col-12 col-sm-auto flex-sm-grow-1 flex-lg-grow-0">
                                <select name="department" id="department" class="form-select me-md-2">
                                    <option value="">Select Option</option>
                                    <?php echo getDepartmentOptions(isset($_POST['department']) ? $_POST['department'] : null); ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contact" name="contact" required
                        value="<?php if(isset($_POST['contact'])) { echo $_POST['contact']; } ?>">
                    <?php
                                    if(isset($_POST['contact']) && !validate_field($_POST['contact'])){
                                ?>
                    <p class="text-danger my-1">Contact Number is required</p>
                    <?php
                                    }
                                ?>
                </div>
                
                <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>">
                    <?php
                                    $new_staff = new teacher_list();
                                    if(isset($_POST['email'])){
                                         $new_staff->email = htmlentities($_POST['email']);
                                    }else{
                                         $new_staff->email = '';
                                    }

                                    if(isset($_POST['email']) && strcmp(validate_email($_POST['email']), 'success') != 0)
                                        ?>
                                    
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required
                        value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>">
                    <?php
                                    if(isset($_POST['password']) && strcmp(validate_password($_POST['password']), 'success') != 0){
                                ?>
                    <p class="text-danger my-1">
                        <?php echo validate_password($_POST['password']) ?>
                    </p>
                    <?php
                                    }
                                ?>
                </div>

                <button type="submit" name="save" class="btn btn-primary mt-2 mb-3 brand-bg-color"
                    id="addStaffButton">Add teacher</button>
            </form>
        </div>
    </main>
    </div>
    </div>
</main>
<?php
require_once('../includes/script.js.php');
?>
</body>
</html>