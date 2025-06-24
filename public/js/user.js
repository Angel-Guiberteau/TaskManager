
document.querySelectorAll('.btn-start').forEach(button => {
    button.addEventListener('click', function(e) {
        const taskId = this.getAttribute('data-task-start-id'); 

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
                    text: "Yes, start it!", 
                    value: true, 
                    visible: true,
                    className: "btn-confirm", 
                    closeModal: true 
                }
            },
        }).then(function(result) {
            if (result) {
                window.location.href = '/startTask/' + taskId;
            }
        });
    });
});

document.querySelectorAll('.btn-end').forEach(button => {
    button.addEventListener('click', function(e) {
        const taskId = this.getAttribute('data-task-end-id'); 

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
                    text: "Yes, start it!", 
                    value: true, 
                    visible: true,
                    className: "btn-confirm", 
                    closeModal: true 
                }
            },
        }).then(function(result) {
            if (result) {
                window.location.href = '/endTask/' + taskId;
            }
        });
    });
});

function filterTasks() {
    let taskSearch = document.getElementById('taskSearch').value.toLowerCase();
    let userFilter = document.getElementById('userFilter').value.toLowerCase();
    let dateFilter = document.getElementById('dateFilter').value;

   
    let taskCards = document.querySelectorAll('.taskUserCard');
    
    taskCards.forEach(card => {
        let taskName = card.getAttribute('data-name').toLowerCase();
        let taskUser = card.getAttribute('data-user').toLowerCase();
        let taskResolutionDate = card.getAttribute('data-date');

        let nameMatch = taskName.includes(taskSearch);
        let userMatch = (userFilter === "" || taskUser.includes(userFilter));
        let dateMatch = (dateFilter === "" || taskResolutionDate === dateFilter);


        if (nameMatch && userMatch && dateMatch) {
            card.closest('.col-md-6').style.display = '';
        } else {
            card.closest('.col-md-6').style.display = 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', filterTasks);

document.getElementById('taskSearch').addEventListener('input', filterTasks);
document.getElementById('userFilter').addEventListener('change', filterTasks);
document.getElementById('dateFilter').addEventListener('change', filterTasks);
