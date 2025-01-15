<nav class="navbar">
        <div class="logo">
            <h3>LIBRARY</h3>
        </div>
        <div class="link">
            <a href="index.php#home">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#bestSeller">Top Books</a>
            <a href="index.php#contact">Contact</a>
        </div>
        <div class="link2">
            <?php if(isset($_SESSION['login'])) : ?>
            <a class="user" href="dashboard.php">
                <span><?= $user_login[0]['nama_user'] ?></span>
                <img src="img/profile/<?= $user_login[0]['profile'] ?>" width="40" alt="">
            </a>
            <?php else : ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </nav>