document.addEventListener("DOMContentLoaded", function () {
    const taskSearch = document.getElementById("taskSearch");
    const userFilter = document.getElementById("userFilter");
    const dateFilter = document.getElementById("dateFilter");
    const taskCards = document.querySelectorAll(".task-card");

    function filterTasks() {
        const searchText = taskSearch.value.toLowerCase();
        const selectedUser = userFilter.value;
        const selectedDate = dateFilter.value;
        
        taskCards.forEach(card => {
            const taskName = card.getAttribute("data-task-name").toLowerCase();
            const assignedUser = card.getAttribute("data-assigned-user");
            const finishDate = card.getAttribute("data-finish-date");
            
            const matchesTask = taskName.includes(searchText);
            const matchesUser = selectedUser === "" || assignedUser === selectedUser;
            const matchesDate = selectedDate === "" || finishDate === selectedDate;
            
            if (matchesTask && matchesUser && matchesDate) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    taskSearch.addEventListener("input", filterTasks);
    userFilter.addEventListener("change", filterTasks);
    dateFilter.addEventListener("change", filterTasks);
});