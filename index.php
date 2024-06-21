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
<?php require_once __DIR__ . '/views/navbar.php' ?>
<?php if (isset($_SESSION["user_id"])): ?>
<div class="list-container">
    <div class="list to-do-list">
        <h3>Todo</h3>
        <div class="item-container">
            <?php require_once "controllers/task_controller.php";
            $controller = new controllers\task_controller();
            $tasks = $controller->get_tasks(1);
            foreach ($tasks as $task) {
                echo "<div class='list-item'>
                    <div class='list-item-content'>
                        <p class='task-description'>{$task['description']}</p>
                        <i class='task-due'>{$task['due_to']}</i>
                    </div>
                    <div class='list-item-actions'>
                        <i class='bi bi-pencil'></i>
                        <i class='bi bi-trash'></i>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
        <div class="list working-on-list">
            <h3>Working on</h3>
            <div class="item-container">
                <?php
                $tasks = $controller->get_tasks(2);
                foreach ($tasks as $task) {
                    echo "<div class='list-item'>
                    <div class='list-item-content'>
                        <p class='task-description'>{$task['description']}</p>
                        <i class='task-due'>{$task['due_to']}</i>
                    </div>
                    <div class='list-item-actions'>
                        <i class='bi bi-pencil'></i>
                        <i class='bi bi-trash'></i>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
        <div class="list done-list">
            <h3>Done</h3>
            <div class="item-container">
                <?php
                $tasks = $controller->get_tasks(3);
                foreach ($tasks as $task) {
                    echo "<div class='list-item'>
                    <div class='list-item-content'>
                        <p class='task-description'>{$task['description']}</p>
                        <i class='task-due'>{$task['due_to']}</i>
                    </div>
                    <div class='list-item-actions'>
                        <i class='bi bi-pencil'></i>
                        <i class='bi bi-trash'></i>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="add-task">
        <form action="controllers/task_controller.php" method="post">
            <h3>Create task</h3>
            <input type="hidden" name="action" value="add_task">
            <label for="text">Add task:</label> <!-- Přidat label tag -->
            <input type="text" name="description" placeholder="Task:">
            <label for="date">Due:</label> <!-- Přidat label tag -->
            <input type="date" name="due_to">
            <label for="status">Pick your progress</label> <!-- Přidat label tag -->
            <select name="status">
                <?php
                require_once "controllers/task_controller.php";
                $controller = new controllers\task_controller();
                $statuses = $controller->get_statuses();
                foreach ($statuses as $status) {
                    echo "<option value='{$status['id']}'>{$status['name']}</option>";
                }
                ?>
            </select> <!-- Uzavřít select tag -->
            <button type="submit" class="button-submit">Add</button>
        </form>
    </div>
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