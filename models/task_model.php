<?php

namespace models;

require_once "database.php";

class task
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }

    public function get_tasks($status_id)
    {
        $id = $_SESSION['user_id'];
        $description = null;
        $created_at = null;
        $updated_at = null;
        $end_at = null;

        $conn = $this->db->db_connect();
        if ($conn === false) {
            die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
        }
        $sql = "SELECT * from tasks where user_id = ? and status_id = ?";
        //check if are some task in the database
        if ($id === null || $status_id === null) {
            die("CHYBA: něco je NULL :D. " . $conn->error);
        }

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
        }
        $stmt->bind_param('ii', $_SESSION['user_id'], $status_id);
        $stmt->execute();
        $stmt->bind_result($id, $description, $created_at, $updated_at, $end_at, $status_id, $user_id);
        $tasks = [];
        while ($stmt->fetch()) {
            $tasks[] = [
                "id" => $id,
                "description" => $description,
                "created_at" => $created_at,
                "updated_at" => $updated_at,
                "due_to" => $end_at,
            ];
        }
        $stmt->close();
        return $tasks;

    }

    public function get_statuses()
    {
        $id = null;
        $name = null;

        $conn = $this->db->db_connect();
        if ($conn === false) {
            die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
        }
        $sql = "SELECT * from statuses";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
        }
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $statuses = [];
        while ($stmt->fetch()) {
            $statuses[] = [
                "id" => $id,
                "name" => $name,
            ];
        }
        $stmt->close();
        return $statuses;
    }

    public function add_task()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];
            $due_to = $_POST['due_to'];
            $status = $_POST['status'];
            $created_at = date("Y-m-d");
            $updated_ad = date("Y-m-d");
            $user_id = $_SESSION['user_id'];


            $conn = $this->db->db_connect();
            if ($conn === false) {
                die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
            }
            $sql = "CALL add_task(?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
            }
            $stmt->bind_param('ssssii', $description, $created_at, $updated_ad, $due_to, $status, $user_id);
            $stmt->execute();
            $stmt->close();
            header("Location: /index.php");
        }
    }

    public function delete_task()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task_id = $_POST['task_id'];

            $conn = $this->db->db_connect();
            if ($conn === false) {
                die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
            }
            $sql = "DELETE from tasks where task_id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
            }
            $stmt->bind_param('i', $task_id);
            $stmt->execute();
            $stmt->close();
            header("Location: /index.php");
        }
    }

    public function get_task_by_id($task_id) {
        $conn = $this->db->db_connect();
        if ($conn === false) {
            die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
        }
        $sql = "SELECT * FROM tasks WHERE task_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
        }
        $stmt->bind_param('i', $task_id);
        $stmt->execute();
        $stmt->bind_result($id, $description, $created_at, $updated_at, $end_at, $status_id, $user_id);
        $task = null;
        if ($stmt->fetch()) {
            $task = [
                "id" => $id,
                "description" => $description,
                "created_at" => $created_at,
                "updated_at" => $updated_at,
                "due_to" => $end_at,
                "status_id" => $status_id,
                "user_id" => $user_id,
            ];
        }
        $stmt->close();
        return $task;
    }


public function edit_task()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task_id = $_POST['task_id'];
            $description = $_POST['description'];
            $updated_at = date("Y-m-d");
            $due_to = $_POST['due_to'];
            $status = $_POST['status'];

            $conn = $this->db->db_connect();
            if ($conn === false) {
                die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
            }
            $sql = "UPDATE tasks set description = ?, updated_at = ?, end_at = ?, status_id = ? where task_id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
            }
            $stmt->bind_param('ssssi', $description, $updated_at, $due_to, $status, $task_id);
            $stmt->execute();
            $stmt->close();
            header("Location: /index.php");
        }
    }


}