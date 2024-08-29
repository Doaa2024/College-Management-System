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
standardTheme.addEventListener("click", () => changeTheme("standard"));
lightTheme.addEventListener("click", () => changeTheme("light"));
darkerTheme.addEventListener("click", () => changeTheme("darker"));

// Check if one theme has been set previously and apply it (or std theme if not found):
let savedTheme = localStorage.getItem("savedTheme");
savedTheme === null ? changeTheme("standard") : changeTheme(savedTheme);

// Functions
function addToDo(event) {
  event.preventDefault();
  console.log("Add ToDo button clicked");

  if (toDoInput.value === "") {
    alert("You must write something!");
    return;
  }

  const toDoDiv = document.createElement("div");
  toDoDiv.classList.add("todo", `${savedTheme}-todo`);
  console.log("Created new to-do div with class:", toDoDiv.className);

  const newToDo = document.createElement("li");
  newToDo.innerText = toDoInput.value;
  newToDo.classList.add("todo-item");
  toDoDiv.appendChild(newToDo);

  const checked = document.createElement("button");
  checked.innerHTML = '<i class="fas fa-check"></i>';
  checked.classList.add("check-btn", `${savedTheme}-button`);
  toDoDiv.appendChild(checked);

  const deleted = document.createElement("button");
  deleted.innerHTML = '<i class="fas fa-trash"></i>';
  deleted.classList.add("delete-btn", `${savedTheme}-button`);
  toDoDiv.appendChild(deleted);

  const edited = document.createElement("button");
  edited.innerHTML = '<i class="fas fa-pen"></i>';
  edited.classList.add("edit-btn", `${savedTheme}-button`);
  toDoDiv.appendChild(edited);

  toDoList.appendChild(toDoDiv);
  console.log("Appended new to-do item to the list");
  toDoInput.value = "";

  // Adding to local storage and server
  sendRequest("add", { task: newToDo.innerText }, (response) => {
    toDoDiv.dataset.id = response.id; // Assign the ID received from the server
    console.log("Received new to-do ID from the server:", response.id);
  });
}

function deletecheck(event) {
  const item = event.target;
  const toDoDiv = item.parentElement;
  const id = toDoDiv.dataset.id;

  if (!id) {
    console.error("No ID found for the to-do item.");
    return;
  }

  if (item.classList.contains("delete-btn")) {
    toDoDiv.classList.add("fall");
    sendRequest("delete", { id: id }, () => {
      toDoDiv.addEventListener("transitionend", function () {
        toDoDiv.remove();
      });
    });
  } else if (item.classList.contains("check-btn")) {
    toDoDiv.classList.toggle("completed");
    const completed = toDoDiv.classList.contains("completed") ? 1 : 0;
    console.log(`Check button clicked for ID: ${id} Completed: ${completed}`);
    sendRequest("update", { id: id, completed: completed });
  } else if (item.classList.contains("edit-btn")) {
    editToDoItem(toDoDiv);
  }
}

function editToDoItem(toDoDiv) {
  const toDoItem = toDoDiv.querySelector(".todo-item");
  const newToDo = prompt("Edit your to-do:", toDoItem.innerText);

  if (newToDo !== null && newToDo.trim() !== "") {
    console.log("To-do item edited:", newToDo);
    toDoItem.innerText = newToDo;
    sendRequest("update", { id: toDoDiv.dataset.id, task: newToDo });
  }
}

function sendRequest(action, data, callback = null) {
  console.log("Sending request:", action, data);
  fetch("todo.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: action,
      ...data,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "error") {
        alert(data.message);
      } else if (callback) {
        callback(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function getTodos() {
    fetch('todo.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({ action: 'get' })
    })
    .then(response => response.json())
    .then(todos => {
      todos.forEach(todo => {
        const toDoDiv = document.createElement("div");
        toDoDiv.classList.add("todo", `${savedTheme}-todo`);
        toDoDiv.dataset.id = todo.id;
  
        if (todo.completed == 1) { // Ensure comparison is done correctly
          toDoDiv.classList.add("completed");
        }
  
        const newToDo = document.createElement("li");
        newToDo.innerText = todo.task;
        newToDo.classList.add("todo-item");
        toDoDiv.appendChild(newToDo);
  
        const checked = document.createElement("button");
        checked.innerHTML = '<i class="fas fa-check"></i>';
        checked.classList.add("check-btn", `${savedTheme}-button`);
        toDoDiv.appendChild(checked);
  
        const deleted = document.createElement("button");
        deleted.innerHTML = '<i class="fas fa-trash"></i>';
        deleted.classList.add("delete-btn", `${savedTheme}-button`);
        toDoDiv.appendChild(deleted);
  
        const edited = document.createElement("button");
        edited.innerHTML = '<i class="fas fa-pen"></i>';
        edited.classList.add("edit-btn", `${savedTheme}-button`);
        toDoDiv.appendChild(edited);
  
        toDoList.appendChild(toDoDiv);
      });
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
  

function changeTheme(color) {
  localStorage.setItem("savedTheme", color);
  savedTheme = localStorage.getItem("savedTheme");
  console.log("Theme changed to:", color);

  document.body.className = color;
  color === "darker"
    ? document.getElementById("title").classList.add("darker-title")
    : document.getElementById("title").classList.remove("darker-title");

  document.querySelector("input").className = `${color}-input`;
  document.querySelectorAll(".todo").forEach((todo) => {
    Array.from(todo.classList).some((item) => item === "completed")
      ? (todo.className = `todo ${color}-todo completed`)
      : (todo.className = `todo ${color}-todo`);
  });

  document.querySelectorAll("button").forEach((button) => {
    Array.from(button.classList).some((item) => {
      if (item === "check-btn") {
        button.className = `check-btn ${color}-button`;
      } else if (item === "delete-btn") {
        button.className = `delete-btn ${color}-button`;
      } else if (item === "edit-btn") {
        button.className = `edit-btn ${color}-button`;
      }
    });
  });
}
