<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="post.php">我要留言</a>
        </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <?php if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin']) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">登出</a>
                </li>
            <?php } else {?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">註冊</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">登入</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    </nav>
</div>