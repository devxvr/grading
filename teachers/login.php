<?php
session_start();

if (isset($_SESSION['teachers_list']) && $_SESSION['teachers_list'] == 'teacher_list') {
    header('location: ./dashboard.php');
    exit(); 
}

require_once('../admin/account-class.php');

if (isset($_POST['login'])) {
    $account = new Account();
    $account->email = htmlentities($_POST['email']); // Make sure you sanitize input
    $account->password = htmlentities($_POST['password']); // Sanitize input

    if ($account->sign_in_teacher()) {
        $_SESSION['teachers_list'] = 'teacher_list'; // Ensure session key is consistent
        header('location: ./dashboard.php');
        exit(); // Always exit after redirection
    } else {
        $error = 'Invalid email/password. Try again.';
    }
}
?>

<?php
$title = 'Home';
require_once('../includes/head.login.php');
?>
<body>
    <main>
        <form action="" method="post">
            <section class="box">
                <div class="content">
                    <div class="all">
                        <div class="both">
                            <div class="logo"><img src="images/final-logo.png" alt="" class="log1"></div>
                            <div class="teach-login">
                                <p class="log">Admin Login</p>
                            </div>
                        </div>
                        <div class="for-login">
                            <div class="name">
                                <label for="email"></label>
                                <input type="text" name="email" id="email" placeholder="Email" class="email" required value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>">
                            </div>
                            <div class="password">
                                <label for="password"></label>
                                <input type="password" name="password" id="password" placeholder="Password" class="password" value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>">
                            </div>
                        </div>
                        <div class="both-1">
                            <?php
                            if (isset($_POST['login']) && isset($error)) {
                                ?>
                                <p class="text-danger mt-3 text-center"><?= $error ?></p>
                            <?php
                            }
                            ?>
                            <div class="btn">
                                <button type="submit" class="login" name="login">Log in</button>
                            </div>
                            <div class="admin">
                                <p class="log-admin"><a href="../admin/login.php" class="highlight">Login As Admin</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php if (isset($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </form>
    </main>
</body>
</html>
