<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Mainpage</title>
    <?php session_start(); ?>
</head>
<body>
<?php if (isset($_SESSION["user_id"])): ?>
        <h1>Vítejte, <?php echo $_SESSION['username']; ?></h1>
    <form action="../controllers/user_controller.php" method="post">
        <input type="hidden" name="action" value="logout">
        <button type="submit" class="btn-header">
            <i class="bi bi-door-open-fill"></i>
        </button>
    </form>
<?php else: ?>
<div class="container" id="container">
    <div class="form-container" id="form-container">
        <div class="form" id="form-login">
            <h2>Přihlášení</h2>
            <form action="../controllers/user_controller.php" method="post">
                <input type="hidden" name="action" value="login">
                <label for="email">Email:</label><br>
                <input type="email" id="email_login" name="email" required><br>
                <label for="password">Heslo:</label><br>
                <input type="password" id="heslo_login" name="password" required><br><br>
                <button type="submit" class="button-submit">Login</button>
            </form>
            <p>Nemáš účet? <a id="show-register">Zaregistrovat se</a></p>
        </div>
        <div class="form" id="form-register" style="display: none;">
            <h2>Registrace</h2>
            <form action="../controllers/user_controller.php" method="post">
                <input type="hidden" name="action" value="register">
                <label for="username">Uživatelské jméno:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email_register" name="email" required><br>
                <label for="heslo">Heslo:</label><br>
                <input type="password" id="heslo_register" name="password" required><br>
                <button class="button-submit" type="submit">Register</button>
            </form>
            <p>Máš účet? <a id="show-login">Přihlásit se</a></p>
        </div>
    </div>
</div>
<?php endif; ?>
</body>
</html>

<script type="text/javascript" src="js/login-register.js"></script>