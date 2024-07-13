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
                        <form method='get'>
                            <input type='hidden' name='action' value='edit_task'>
                            <input type='hidden' name='task_id' value='{$task['id']}'>
                            <button type='submit'><i class='bi bi-pencil'></i></button>
                        </form>
                        <form action='controllers/task_controller.php' method='post'>
                            <input type='hidden' name='action' value='delete_task'>
                            <input type='hidden' name='task_id' value='{$task['id']}'>
                            <button type='submit'><i class='bi bi-trash'></i></button>
                        </form>
                    </div>
                </div>";
                } ?>
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
                        <form method='get'>
                            <input type='hidden' name='action' value='edit_task'>
                            <input type='hidden' name='task_id' value='{$task['id']}'>
                            <button type='submit' class='edit-task-btn'><i class='bi bi-pencil'></i></button>
                        </form>
                        <form action='controllers/task_controller.php' method='post'>
                            <input type='hidden' name='action' value='delete_task'>
                            <input type='hidden' name='task_id' value='{$task['id']}'>
                            <button type='submit'><i class='bi bi-trash'></i></button>
                        </form>
                    </div>
                </div>";
                } ?>
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
                        <form method='get'>
                            <input type='hidden' name='action' value='edit_task'>
                            <input type='hidden' name='task_id' value='{$task['id']}'>
                            <button type='submit'><i class='bi bi-pencil'></i></button>
                        </form>
                        <form action='controllers/task_controller.php' method='post'>
                            <input type='hidden' name='action' value='delete_task'>
                            <input type='hidden' name='task_id' value='{$task['id']}'>
                            <button type='submit'><i class='bi bi-trash'></i></button>
                        </form>
                    </div>
                </div>";
                } ?>
            </div>
        </div>
    </div>
    <!-- Modální okno pro přidání úkolu -->
    <div id="add-task-modal" class="modal-container">
        <div class="modal">
            <span class="close">&times;</span>
            <h2>Přidat úkol</h2>
            <form action="controllers/task_controller.php" method="post">
                <input type="hidden" name="action" value="add_task">
                <label for="description">Popis:</label>
                <input type="text" id="description" name="description" required><br>
                <label for="due_to">Termín:</label>
                <input type="date" id="due_to" name="due_to" required><br>
                <label for="status">Status:</label>
                <select name="status">
                    <?php
                    $statuses = $controller->get_statuses();
                    foreach ($statuses as $status) {
                        $selected = ($task['status_id'] == $status['id']) ? 'selected' : '';
                        echo "<option value='{$status['id']}' $selected>{$status['name']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="button-submit">Přidat</button>
            </form>
        </div>
    </div>

    <!-- Modální okno pro edit úkolu -->
    <div id="edit-task-modal" class="modal-container">
        <div class="modal">
            <?php
            $task = null;
            if (isset($_GET['task_id']) && $_GET['action'] === 'edit_task') {
                $task = $controller->get_task_by_id($_GET['task_id']);
            }
            ?>
            <?php if ($task === null): ?>
                <div class="modal-content">
                    <span class="close" id="modal-close">&times;</span>
                    <p>No task selected</p>
                </div>
            <?php else: ?>
                <script>document.getElementById('edit-task-modal').style.display = 'block';</script>
                <div class="modal-content">
                    <span class="close" id="modal-close">&times;</span>
                    <h2>Upravit úkol</h2>
                    <form action="controllers/task_controller.php" method="post">
                        <input type="hidden" name="action" value="update_task">
                        <input type="hidden" name="task_id" value="<?php echo $task['id'] ?>">
                        <label for="text">Popis:</label>
                        <input type="text" name="description" value="<?php echo $task['description'] ?>">
                        <label for="date">Termín:</label>
                        <input type="date" name="due_to" value="<?php echo $task['due_to'] ?>">
                        <label for="status">Status:</label>
                        <select name="status">
                            <?php
                            $statuses = $controller->get_statuses();
                            foreach ($statuses as $status) {
                                $selected = ($task['status_id'] == $status['id']) ? 'selected' : '';
                                echo "<option value='{$status['id']}' $selected>{$status['name']}</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="button-submit">Upravit</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
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
<script type="text/javascript" src="js/modal.js"></script>