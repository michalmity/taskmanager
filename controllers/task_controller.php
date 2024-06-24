<?php

namespace controllers;

require_once __DIR__ . '/../models/task_model.php';

class task_controller {
    private $task_model;

    public function __construct() {
        $this->task_model = new \models\task();
    }

    public function get_tasks($status_id) {
        return $this->task_model->get_tasks($status_id);
    }

    public function get_statuses() {
        return $this->task_model->get_statuses();
    }

    public function add_task(){
        return $this->task_model->add_task();
    }

    public function delete_task(){
        return $this->task_model->delete_task();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new task_controller();
    $action = $_POST['action'];

    if ($action === 'add_task') {
        $controller->add_task();
    }
    elseif ($action === 'delete_task') {
        $controller->delete_task();
    }
    else {
        die('Invalid action');
    }
}
?>
