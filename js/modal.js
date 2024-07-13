// Získání modálních oken
var addTaskModal = document.getElementById('add-task-modal');
var editTaskModal = document.getElementById('edit-task-modal');

// Získání tlačítek pro otevření modálních oken
var addTaskBtn1 = document.getElementsByClassName('add-task-btn')[0];
var addTaskBtn2 = document.getElementsByClassName('add-task-btn')[1];
var editTaskBtns = document.getElementsByClassName('edit-task-btn');

// Získání prvků pro zavření modálních oken
var closeButtons = document.getElementsByClassName('close');

// Otevření modálního okna pro přidání úkolu
addTaskBtn1.onclick = function () {
    addTaskModal.style.display = 'block';
}

addTaskBtn2.onclick = function () {
    addTaskModal.style.display = 'block';
}

// Otevření modálního okna pro úpravu úkolu
for (var i = 0; i < editTaskBtns.length; i++) {
    editTaskBtns[i].onclick = function () {
        var taskId = this.getAttribute('data-task-id');
        var taskDesc = this.getAttribute('data-task-desc');
        var taskDue = this.getAttribute('data-task-due');
        var taskStatus = this.getAttribute('data-task-status');
        document.getElementById('edit_task_id').value = taskId;
        document.getElementById('edit_description').value = taskDesc;
        document.getElementById('edit_due_to').value = taskDue;
        document.getElementById('edit_status').value = taskStatus;
        editTaskModal.style.display = 'block';
    }
}

// Zavření modálního okna při kliknutí na X
for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].onclick = function () {
        addTaskModal.style.display = 'none';
        editTaskModal.style.display = 'none';
    }
}

// Zavření modálního okna při kliknutí mimo něj
window.onclick = function (event) {
    if (event.target == addTaskModal) {
        addTaskModal.style.display = 'none';
    }
    if (event.target == editTaskModal) {
        editTaskModal.style.display = 'none';
    }
}