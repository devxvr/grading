<?php
    
    require_once '../classes/admin.class.php';
    require_once  '../php/functions.php';

    
    //  session_start();
     
    //  if (!isset($_SESSION['user']) || $_SESSION['user'] != 'admin'){
    //     header('location: ./login.php');
    //  }
    
    

    if(isset($_POST['save'])){

        $admin = new admin_list();
        //sanitize
        $admin->fullname = htmlentities($_POST['fullname']);
        $admin->username = htmlentities($_POST['username']);
        $admin->password = htmlentities($_POST['password']);
        

        //validate
        if (validate_field($admin->fullname) &&
        validate_field($admin->username) &&
        validate_field($admin->password) &&
        validate_password($admin->password)()){
            if($admin->add()){
                header('location: admin-admin.php');
            }else{
                echo 'An error occured while adding in the database.';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">

    <title>Admin Staffs</title>
</head>
<nav class="navbar navbar-expand-lg p-4" style="background-color: #0D1321;">
    <div class="container-fluid">
        <div class="company-name">
            <h2>RLcompany</h2>
        </div>
        <div class="div">
            <img src="../img/logo.png" class="logo">
            <li class="nav-item dropdown " style="list-style: none;">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color: white;">
                    Aljas, Ronald L.
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="">Profile</a></li>
                    <li><a class="dropdown-item" href="./logout.php">Logout</a></li>

                </ul>

            </li>
        </div>
    </div>
</nav>
<main>
    <div class="container">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block  sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin-dashboard.php">
                            <i class="fa fa-tachometer " aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-accounts.php">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Accounts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-application.php">
                            <i class="fa fa-users" aria-hidden="true"></i>
                                Application
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-admin.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                                admin_list
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-settings.php">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                                Settings
                            </a>
                        </li>
                        <hr class="d-lg">
                        <li class="nav-item">
                            <a class="nav-link" style="margin-top: 250px;" href="./logout.php">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                Logout
                            </a>
                        </li>
                    </ul>

            </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-12 col-lg-6 d-flex justify-content-between align-items-center">
            <h2 class="h3 brand-color pt-3 pb-2">Add admin_list</h2>
            <a href="admin.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left"
                    aria-hidden="true"></i> Back</a>
        </div>
        <div class="col-12 col-lg-6">
            <form method="post" action="">
                <div class="mb-2">
                    <label for="fullname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required
                        value="<?php if(isset($_POST['fullname'])) { echo $_POST['fullname']; } ?>">
                    <?php
                                    if(isset($_POST['fullname']) && !validate_field($_POST['fullname'])){
                                ?>
                    <p class="text-danger my-1">First name is required</p>
                    <?php
                                    }
                                ?>
                </div>
                <div class="mb-2">
                    <label for="username" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="username" name="username" required
                        value="<?php if(isset($_POST['username'])) { echo $_POST['username']; } ?>">
                    <?php
                                    if(isset($_POST['username']) && !validate_field($_POST['username'])){
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

                                    if(isset($_POST['email']) && strcmp(validate_email($_POST['email']), 'success') != 0){
                                ?>
                    <p class="text-danger my-1">
                        <?php echo validate_email($_POST['email']) ?>
                    </p>
                    <?php
                                    }else if ($new_staff->is_email_exist() && $_POST['email']){
                                ?>
                    <p class="text-danger my-1">Email already exist</p>
                    <?php      
                                    }
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
                <div class="mb-2">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required
                        value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>">
                    <?php
                                    if(isset($_POST['address']) && !validate_field($_POST['address'])){
                                ?>
                    <p class="text-danger my-1">Address is required</p>
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
                <button type="submit" name="save" class="btn btn-primary mt-2 mb-3 brand-bg-color"
                    id="addStaffButton">Add admin_list</button>
            </form>
        </div>
    </main>
    </div>
    </div>
</main>

<script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>

</body>
</html>