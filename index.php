<!DOCTYPE html>
<html lang="en">

<?php
    $title = 'Home';
    require_once('includes/head.login.php');
?>

<body>
    <main>
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
                        <input type="text" name="username" id="username" placeholder="Username" class="username">
                    </div>
                    <div class="password">
                        <input type="password" name="password" id="password" placeholder="Password" class="password">
                    </div>
                </div>
                </form>
                <div class="both-1">
                <div class="btn">
                    <a href="../teacher/sidebar.html"><button type="submit" class="login">Log in</button></a>
                </div>
                <div class="admin">
                    <p class="log-admin"><a href="login.php" class="highlight">Login As Teacher</a></p>
                </div>
            </div>
            </div>
            </div>
        </section>
    </main>
</body>

</html>