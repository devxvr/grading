<?php
    
    require_once './adminlist-class.php';
    require_once  './functions.php';

    
      session_start();
     
      if (!isset($_SESSION['user']) || $_SESSION['user'] != 'admin'){
         header('location: ./login.php');
      }
    
    

    if(isset($_POST['save'])){

        $admin = new admin_list();
        //sanitize
        $admin->firstname = htmlentities($_POST['firstname']);
        $admin->middlename = htmlentities($_POST['middlename']);
        $admin->lastname = htmlentities($_POST['lastname']);
        $admin->email = htmlentities($_POST['email']);
        $admin->password = htmlentities($_POST['password']);
        

        //validate
        if (validate_field($admin->firstname) &&
        validate_field($admin->lastname) &&
        validate_field($admin->email) &&
        validate_field($admin->password) &&
        validate_password($admin->password) &&
        validate_email($admin->email) && !$admin->is_email_exist()){
            if($admin->add()){
                header('location: admin-admin.php');
            }else{
                echo 'An error occured while adding in the database.';
            }
        }
    }
?>
<?php
$title = 'Admin';
require_once '../includes/head.php';
?>

<body>
<?php
require_once('../includes/sidebar.admin.php');
?>  
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-12 col-lg-6 d-flex justify-content-between align-items-center">
            <h2 class="h3 brand-color pt-3 pb-2">Add Admin</h2>
            <a href="admin.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left"
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
                
                <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>">
                    <?php
                                    $new_staff = new admin_list();
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
                    id="addStaffButton">Add Admin</button>
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