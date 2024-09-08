const toDoInput = document.querySelector(".todo-input");
const toDoBtn = document.querySelector(".todo-btn");
const toDoList = document.querySelector(".todo-list");
const standardTheme = document.querySelector(".standard-theme");
const lightTheme = document.querySelector(".light-theme");
const darkerTheme = document.querySelector(".darker-theme");

// Event Listeners
toDoBtn.addEventListener("click", addToDo);
toDoList.addEventListener("click", deletecheck);
document.addEventListener("DOMContentLoaded", getTodos);
standardTheme.addEventListener("click", () => {
  changeTheme("standard");
  window.location.reload();
});

lightTheme.addEventListener("click", () => {
  changeTheme("light");
  window.location.reload();
});

darkerTheme.addEventListener("click", () => {
  changeTheme("darker");
  window.location.reload();
});

// Check if a theme has been set previously and apply it (or set the standard theme if not found):
let savedTheme = localStorage.getItem("savedTheme");
savedTheme === null ? changeTheme("standard") : changeTheme(savedTheme);

// Function to add a to-do with CreatedAt date
function addToDo(event) {
  event.preventDefault();

  if (toDoInput.value === "") {
    alert("You must write something!");
    return;
  }

  const formData = new URLSearchParams({
    action: "add",
    task: toDoInput.value,
  });

  fetch("todo.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        // Reload the page to fetch and display updated to-do list
        window.location.reload();
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
// Function to handle task completion, deletion, and editing
function deletecheck(event) {
  const item = event.target;
  const toDoDiv = item.closest(".todo");
  const id = toDoDiv.dataset.id;

  if (!id) {
    console.error("No ID found for the to-do item.");
    return;
  }

  if (item.classList.contains("delete-btn")) {
    if (confirm("Are you sure you want to delete this task?")) {
      const formData = new URLSearchParams({
        action: "delete",
        id: id,
      });

      fetch("todo.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            // Reload the page to fetch and display updated to-do list
            window.location.reload();
          } else {
            alert(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  } else if (item.classList.contains("check-btn")) {
    const completed = toDoDiv.classList.toggle("completed") ? 1 : 0;
    let completedAt = null;
    if (completed) {
      completedAt = new Date().toLocaleString();
    }

    const formData = new URLSearchParams({
      action: "update",
      id: id,
      completed: completed,
      completedAt: completedAt,
    });

    fetch("todo.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          // Reload the page to fetch and display updated to-do list
          window.location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  } else if (item.classList.contains("edit-btn")) {
    const newTask = prompt(
      "Edit your to-do:",
      toDoDiv.querySelector(".todo-item").innerText
    );

    if (newTask !== null && newTask.trim() !== "") {
      const formData = new URLSearchParams({
        action: "update",
        id: id,
        task: newTask,
      });

      fetch("todo.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            // Reload the page to fetch and display updated to-do list
            window.location.reload();
          } else {
            alert(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  }
}
// Function to get todos from the server and display them with dates
function getTodos() {
  fetch("todo.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({ action: "get" }),
  })
    .then((response) => response.json())
    .then((todos) => {
      todos.forEach((todo) => {
        const toDoDiv = document.createElement("div");
        toDoDiv.classList.add("todo", `${savedTheme}-todo`);
        toDoDiv.dataset.id = todo.id; // Ensure each todo has a unique ID

        if (todo.completed == 1) {
          toDoDiv.classList.add("completed");
        }

        // Create the task-container div for task title and buttons
        const taskContainer = document.createElement("div");
        taskContainer.classList.add("task-container");
        toDoDiv.appendChild(taskContainer);

        // Create the to-do task element
        const newToDo = document.createElement("li");
        newToDo.innerText = todo.task;
        newToDo.classList.add("todo-item");
        taskContainer.appendChild(newToDo);

        // Create and append buttons (check, delete, edit)
        const buttonContainer = document.createElement("div");
        buttonContainer.classList.add("button-container");
        taskContainer.appendChild(buttonContainer);

        const checked = document.createElement("button");
        checked.innerHTML = '<i class="fas fa-check"></i>';
        checked.classList.add("check-btn", `${savedTheme}-button`);
        buttonContainer.appendChild(checked);

        const deleted = document.createElement("button");
        deleted.innerHTML = '<i class="fas fa-trash"></i>';
        deleted.classList.add("delete-btn", `${savedTheme}-button`);
        buttonContainer.appendChild(deleted);

        const edited = document.createElement("button");
        edited.innerHTML = '<i class="fas fa-pen"></i>';
        edited.classList.add("edit-btn", `${savedTheme}-button`);
        buttonContainer.appendChild(edited);

        // Create a container for dates
        const datesContainer = document.createElement("div");
        datesContainer.classList.add("dates-container");
        toDoDiv.appendChild(datesContainer);

        // Append CreatedAt date
        const createdDateElement = document.createElement("p");
        createdDateElement.classList.add("created-date");
        createdDateElement.innerText = `Created at: ${todo.CreatedAt}`;
        datesContainer.appendChild(createdDateElement);

        // Append CompletedAt date if task is completed
        if (todo.completed == 1 && todo.CompletedAt) {
          const completedDateElement = document.createElement("p");
          completedDateElement.classList.add("completed-date");
          completedDateElement.innerText = `Completed at: ${todo.CompletedAt}`;
          datesContainer.appendChild(completedDateElement);
        }

        toDoList.appendChild(toDoDiv);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Function to change the theme and update classes
function changeTheme(color) {
  localStorage.setItem("savedTheme", color);
  savedTheme = localStorage.getItem("savedTheme");
  console.log("Theme changed to:", color);

  document.body.className = color;
  color === "darker"
    ? (document.getElementById("title").style.color = "#fff")
    : (document.getElementById("title").style.color = "#000");

  document.querySelectorAll(".todo").forEach((el) => {
    el.className = `todo ${savedTheme}-todo`;
  });

  document
    .querySelectorAll(".check-btn, .delete-btn, .edit-btn")
    .forEach((el) => {
      el.className = `check-btn ${savedTheme}-button`;
    });
}
