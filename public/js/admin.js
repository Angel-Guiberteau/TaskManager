document.addEventListener("DOMContentLoaded", function () {

    // Reset the form when the modal is closed
    var taskModal = document.getElementById('taskModal');
    taskModal.addEventListener('show.bs.modal', function () {
        var form = taskModal.querySelector('form');
        form.reset();
    });

    // Function to create error message
    function createErrorMessage(field, message) {
        let errorMessage = field.nextElementSibling;
        if (!errorMessage || !errorMessage.classList.contains("invalid-feedback")) {
            errorMessage = document.createElement("div");
            errorMessage.classList.add("invalid-feedback");
            field.parentNode.appendChild(errorMessage);
        }
        errorMessage.textContent = message;
    }

    // Realtime validation for Create Task Form
    const taskForm = document.getElementById("taskForm");

    const taskName = document.getElementById("taskName");
    taskName.addEventListener("input", function () {
        if (taskName.value.trim() === "") {
            taskName.classList.add("is-invalid");
            createErrorMessage(taskName, "🔴 The task name is required.");
        } else {
            taskName.classList.remove("is-invalid");
            if (taskName.nextElementSibling && taskName.nextElementSibling.classList.contains("invalid-feedback")) {
                taskName.nextElementSibling.remove();
            }
        }
    });

    const taskDescription = document.getElementById("taskDescription");
    taskDescription.addEventListener("input", function () {
        if (taskDescription.value.trim() === "") {
            taskDescription.classList.add("is-invalid");
            createErrorMessage(taskDescription, "📝 The description is required.");
        } else {
            taskDescription.classList.remove("is-invalid");
            if (taskDescription.nextElementSibling && taskDescription.nextElementSibling.classList.contains("invalid-feedback")) {
                taskDescription.nextElementSibling.remove();
            }
        }
    });

    const assignedUser = document.getElementById("assignedUser");
    assignedUser.addEventListener("change", function () {
        if (assignedUser.value === "") {
            assignedUser.classList.add("is-invalid");
            createErrorMessage(assignedUser, "👤 Please select an assigned user.");
        } else {
            assignedUser.classList.remove("is-invalid");
            if (assignedUser.nextElementSibling && assignedUser.nextElementSibling.classList.contains("invalid-feedback")) {
                assignedUser.nextElementSibling.remove();
            }
        }
    });

    const priority = document.getElementById("priority_id");
    priority.addEventListener("change", function () {
        if (priority.value === "") {
            priority.classList.add("is-invalid");
            createErrorMessage(priority, "⚠️ Please select a priority level.");
        } else {
            priority.classList.remove("is-invalid");
            if (priority.nextElementSibling && priority.nextElementSibling.classList.contains("invalid-feedback")) {
                priority.nextElementSibling.remove();
            }
        }
    });

    const resolutionDate = document.getElementById("resolutionDate");
    resolutionDate.addEventListener("input", function () {
        const today = new Date().toISOString().split("T")[0];
        if (resolutionDate.value === "" || resolutionDate.value < today) {
            resolutionDate.classList.add("is-invalid");
            createErrorMessage(resolutionDate, resolutionDate.value === "" ? "📅 Please select a resolution date." : "🚫 Resolution date cannot be in the past.");
        } else {
            resolutionDate.classList.remove("is-invalid");
            if (resolutionDate.nextElementSibling && resolutionDate.nextElementSibling.classList.contains("invalid-feedback")) {
                resolutionDate.nextElementSibling.remove();
            }
        }
    });

    // Edit form validation in real-time
    const taskEditDescription = document.getElementById("taskEditDescription");
    taskEditDescription.addEventListener("input", function () {
        if (taskEditDescription.value.trim() === "") {
            taskEditDescription.classList.add("is-invalid");
            createErrorMessage(taskEditDescription, "📝 The description is required.");
        } else {
            taskEditDescription.classList.remove("is-invalid");
            if (taskEditDescription.nextElementSibling && taskEditDescription.nextElementSibling.classList.contains("invalid-feedback")) {
                taskEditDescription.nextElementSibling.remove();
            }
        }
    });

    const resolutionDateEdit = document.getElementById("resolutionDateEdit");
    resolutionDateEdit.addEventListener("input", function () {
        const today = new Date().toISOString().split("T")[0];
        if (resolutionDateEdit.value === "" || resolutionDateEdit.value < today) {
            resolutionDateEdit.classList.add("is-invalid");
            createErrorMessage(resolutionDateEdit, resolutionDateEdit.value === "" ? "📅 Please select a resolution date." : "🚫 Resolution date cannot be in the past.");
        } else {
            resolutionDateEdit.classList.remove("is-invalid");
            if (resolutionDateEdit.nextElementSibling && resolutionDateEdit.nextElementSibling.classList.contains("invalid-feedback")) {
                resolutionDateEdit.nextElementSibling.remove();
            }
        }
    });

    // Form create validation
    taskForm.addEventListener("submit", function (event) {
        let isValid = true;
        let errorMessages = [];
    
        if (taskName.value.trim() === "") {
            isValid = false;
            errorMessages.push("🔴 The task name is required.");
            taskName.classList.add("is-invalid");
        }
    
        if (taskDescription.value.trim() === "") {
            isValid = false;
            errorMessages.push("📝 The description is required.");
            taskDescription.classList.add("is-invalid");
        }
    
        if (assignedUser.value === " ") {  
            isValid = false;
            errorMessages.push("👤 Please select an assigned user.");
            assignedUser.classList.add("is-invalid");
        }
    
        if (priority.value === " ") {  
            isValid = false;
            errorMessages.push("⚠️ Please select a priority level.");
            priority.classList.add("is-invalid");
        }
    
        if (resolutionDate.value === "") {
            isValid = false;
            errorMessages.push("📅 Please select a resolution date.");
            resolutionDate.classList.add("is-invalid");
        }
    
        const today = new Date().toISOString().split("T")[0];
        if (resolutionDate.value < today) {
            isValid = false;
            errorMessages.push("🚫 Resolution date cannot be in the past.");
            resolutionDate.classList.add("is-invalid");
        }
    
        if (!isValid) {
            event.preventDefault();
    
            swal({
                title: "Form Validation Error",
                text: errorMessages.join("\n"),
                icon: "error",
                button: "OK",
            });
        }
    });
    
    // Delete task
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (e) {
            const taskId = this.getAttribute('data-task-id');

            swal({
                title: "Are you sure?",
                text: "This action cannot be undone.",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn-cancel",
                        closeModal: true
                    },
                    confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "btn-confirm",
                        closeModal: true
                    }
                },
            }).then(function (result) {
                if (result) {
                    window.location.href = '/deleteTask/' + taskId;
                }
            });
        });
    });

    // Edit form
    const assignedUserSelect = document.getElementById('assignedEditUser');
    const prioritySelect = document.getElementById('priority_idEdit');
    const statusSelect = document.getElementById('statusEdit');

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const taskId = this.getAttribute('data-task-id');
            const taskName = this.getAttribute('data-task-name');
            const taskDescription = this.getAttribute('data-task-description');
            const assignedUser = this.getAttribute('data-task-assigned-user');
            const priority = this.getAttribute('data-task-priority');
            const resolutionDate = this.getAttribute('data-task-resolution-date');
            const startDate = this.getAttribute('data-task-start-date');
            const endDate = this.getAttribute('data-task-end-date');
            const status = this.getAttribute('data-task-status');

            document.getElementById('taskEditId').value = taskId;
            document.getElementById('taskEditName').value = taskName;
            document.getElementById('taskEditDescription').value = taskDescription;
            document.getElementById('resolutionDateEdit').value = resolutionDate;
            document.getElementById('startDateEdit').value = startDate;
            document.getElementById('endDateEdit').value = endDate;

            for (let i = 0; i < assignedUserSelect.options.length; i++) {
                if (assignedUserSelect.options[i].textContent === assignedUser) {
                    assignedUserSelect.selectedIndex = i;
                    break;
                }
            }

            for (let i = 0; i < prioritySelect.options.length; i++) {
                if (prioritySelect.options[i].textContent === priority) {
                    prioritySelect.selectedIndex = i;
                    break;
                }
            }

            for (let i = 0; i < statusSelect.options.length; i++) {
                if (statusSelect.options[i].value == status) {
                    statusSelect.selectedIndex = i;
                    break;
                }
            }
        });
    });

    // Form edit validation
    const taskEditForm = document.getElementById("taskEditForm");

    taskEditForm.addEventListener("submit", function (event) {
        let isValid = true;
        let errorMessages = [];

        const taskDescription = document.getElementById("taskEditDescription");
        if (taskDescription.value.trim() === "") {
            isValid = false;
            errorMessages.push("📝 The description is required.");
            taskDescription.classList.add("is-invalid");
        }

        const assignedUser = document.getElementById("assignedEditUser");
        if (assignedUser.value === "") {
            isValid = false;
            errorMessages.push("👤 Please select an assigned user.");
            assignedUser.classList.add("is-invalid");
        }

        const priority = document.getElementById("priority_idEdit");
        if (priority.value === "") {
            isValid = false;
            errorMessages.push("⚠️ Please select a priority level.");
            priority.classList.add("is-invalid");
        }

        const resolutionDate = document.getElementById("resolutionDateEdit");
        if (resolutionDate.value === "") {
            isValid = false;
            errorMessages.push("📅 Please select a resolution date.");
            resolutionDate.classList.add("is-invalid");
        }

        const today = new Date().toISOString().split("T")[0];
        if (resolutionDate.value < today) {
            isValid = false;
            errorMessages.push("🚫 Resolution date cannot be in the past.");
            resolutionDate.classList.add("is-invalid");
        }

        if (!isValid) {
            event.preventDefault();

            swal({
                title: "Form Validation Error",
                text: errorMessages.join("\n"),
                icon: "error",
                button: "OK",
            });
        }
    });

});
