const API_URL = "http://127.0.0.1:8000/api/tasks";
const USER_API = "http://127.0.0.1:8000/api/user";

const taskList = document.getElementById("taskList");
const token = localStorage.getItem("token");

// 🚨 Stop if not logged in
if (!token) {
  alert("تکایە سەرەتا بچۆ ژوورەوە");
  window.location.href = "/login";
}

// Common headers
const headers = {
  "Content-Type": "application/json",
  "Accept": "application/json",
  "Authorization": `Bearer ${token}`
};

// =======================
// FETCH & SHOW TASKS
// =======================
async function fetchTasks() {
  if (!taskList) return;

  try {
    const res = await fetch(API_URL, { headers });
    if (!res.ok) throw new Error("Unauthorized");

    const tasks = await res.json();
    renderTasks(tasks);
  } catch (err) {
    console.error(err);
  }
}

function renderTasks(tasks) {
  taskList.innerHTML = "";

  tasks.forEach(task => {
    const li = document.createElement("li");
    li.className = "task-item";

    // 👉 Click anywhere on task → Edit page
    li.onclick = () => {
      window.location.href = `/edit-task/${task.id}`;
    };

    // Completed checkbox
    const completeBox = document.createElement("input");
    completeBox.type = "checkbox";
    completeBox.className = "complete-checkbox";

    const completeLabel = document.createElement("label");
    completeLabel.textContent = "تەواوبوون";
    completeLabel.className = "complete-label";

    // ❌ Prevent checkbox click from opening edit page
    completeBox.onclick = async (e) => {
      e.stopPropagation();

      const ok = confirm("ئەم ئەرکە تەواوبوو؟ سڕدەدرێت");
      if (!ok) {
        completeBox.checked = false;
        return;
      }

      await fetch(`${API_URL}/${task.id}`, {
        method: "DELETE",
        headers
      });

      fetchTasks();
    };

    // Task text
    const textBox = document.createElement("div");
    textBox.className = "task-text-box";

    const title = document.createElement("span");
    title.textContent = task.title;
    title.className = "task-title";

    const dateTime = document.createElement("small");
    dateTime.className = "task-datetime";
    dateTime.textContent = formatDateTime(task.due_at);

    textBox.appendChild(title);
    if (task.due_at) textBox.appendChild(dateTime);

    // Right side
    const leftBox = document.createElement("div");
    leftBox.className = "task-complete-box";
    leftBox.appendChild(completeBox);
    leftBox.appendChild(completeLabel);

    li.appendChild(textBox);
    li.appendChild(leftBox);

    taskList.appendChild(li);
  });
}

// =======================
// ADD TASK PAGE LOGIC
// =======================

// Kurdish-only regex
const kurdishRegex = /^[\u0600-\u06FF\s]+$/;

async function saveNewTask() {
  const titleInput = document.getElementById("newTaskInput");
  const dateInput  = document.getElementById("newTaskDateTime");

  if (!titleInput) return; // page safety

  const title = titleInput.value.trim();
  const dateTime  = dateInput ? dateInput.value : null;

  if (!title) {
    alert("تکایە ئەرک بنووسە");
    return;
  }

  if (!kurdishRegex.test(title)) {
    alert("تەنها نووسینی کوردی ڕێگەپێدراوە!");
    return;
  }

  await fetch(API_URL, {
    method: "POST",
    headers,
    body: JSON.stringify({
      title: title,
      due_at: dateTime
    })
  });

  window.location.href = "/";
}


// =======================
// USER INFO
// =======================
async function fetchUser() {
  try {
    const res = await fetch(USER_API, { headers });
    if (!res.ok) throw new Error("Unauthorized");

    const user = await res.json();
    const usernameEl = document.getElementById("username");

    if (usernameEl) {
      usernameEl.textContent = `بەخێربێیت، ${user.name}`;
    }
  } catch (err) {
    console.error(err);
  }
}

// =======================
// LOGOUT
// =======================
async function logout() {
  await fetch("http://127.0.0.1:8000/api/logout", {
    method: "POST",
    headers
  });

  localStorage.removeItem("token");
  window.location.href = "/login";
}

async function loadTaskForEdit() {
  if (typeof TASK_ID === "undefined") return;

  try {
    const res = await fetch(`${API_URL}/${TASK_ID}`, { headers });
    if (!res.ok) throw new Error("Error loading task");

    const task = await res.json();

    document.getElementById("editTaskInput").value = task.title;
    document.getElementById("editTaskDateTime").value = task.due_at ? task.due_at.slice(0, 16) : "";

  } catch (err) {
    console.error(err);
  }
}

async function updateTask() {
  const titleInput = document.getElementById("editTaskInput");
  const dateInput  = document.getElementById("editTaskDateTime");

  const title = titleInput.value.trim();
  const dateTime = dateInput.value;

  if (!title) {
    alert("تکایە ئەرک بنووسە");
    return;
  }

  const res = await fetch(`${API_URL}/${TASK_ID}`, {
    method: "PATCH",
    headers,
    body: JSON.stringify({
      title: title,
      due_at: dateTime || null
    })
  });

  if (!res.ok) {
    alert("هەڵە ڕوویدا");
    return;
  }

  window.location.href = "/";
}


async function deleteTask(taskId) {
  const res = await fetch(`${API_URL}/${taskId}`, {
    method: "DELETE",
    headers
  });

  if (!res.ok) {
    alert("هەڵە ڕوویدا لە سڕینەوەی ئەرک");
    return;
  }

  fetchTasks();
}

function formatDateTime(dateString) {
  if (!dateString) return "";

  const date = new Date(dateString);

  return date.toLocaleString("en-GB", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
    hour: "2-digit",
    minute: "2-digit"
  });
}

// =======================
// INIT
// =======================
fetchUser();
fetchTasks();
loadTaskForEdit();
