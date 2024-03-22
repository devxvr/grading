
<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

    $title = 'Home';
    require_once('includes/head.login.php');
?>
<body>
    <main>
        <form action="./admin/dashboard.php" method="post">
        <section class="box">
            <div class="content">
                <div class="all">
                <div class="both">
                <div class="logo"><img src="images/final-logo.png" alt="" class="log1"></div>
                <div class="teach-login">
                    <p class="log">Admin Login</p>
                </div>
            </div>
                <form action="">
                    <div class="for-login">
                    <div class="name">
                        
                        <label for="username"></label>
                        <input type="text" name="username" id="username" placeholder="Username" class="username" required>
                    </div>
                    <div class="password">
                        <label for="password"></label>
                        <input type="password" name="password" id="password" placeholder="Password" class="password">
                    </div>
                </div>
                </form>
                <div class="both-1">
                <div class="btn">
                    <a href="../teacher/sidebar.html"><button type="submit" class="login">Log in</button></a>
                </div>
                <div class="admin">
                    <p class="log-admin"><a href="./teachers/login.php" class="highlight">Login As Teacher</a></p>
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