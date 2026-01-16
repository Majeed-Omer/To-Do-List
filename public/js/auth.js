const API = "http://127.0.0.1:8000/api";

// REGISTER
async function register() {
  try {
    const res = await fetch(API + "/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json"
      },
      body: JSON.stringify({
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
      })
    });

    const data = await res.json();

    if (!res.ok) {
      alert(data.message || "هەڵە ڕوویدا");
      return;
    }

    localStorage.setItem("token", data.token);
    window.location.href = "/";
  } catch (err) {
    console.error(err);
  }
}

// LOGIN
async function login() {
  try {
    const res = await fetch(API + "/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json"
      },
      body: JSON.stringify({
        email: document.getElementById("loginEmail").value,
        password: document.getElementById("loginPassword").value
      })
    });

    const data = await res.json();

    if (!res.ok) {
      alert("ئیمەیڵ یان وشەی نهێنی هەڵەیە");
      return;
    }

    localStorage.setItem("token", data.token);
    window.location.href = "/";
  } catch (err) {
    console.error(err);
  }
}


// ===== ENTER KEY SUPPORT =====

// Login page Enter key
const loginEmail = document.getElementById("loginEmail");
const loginPassword = document.getElementById("loginPassword");

if (loginEmail && loginPassword) {
  [loginEmail, loginPassword].forEach(input => {
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        login();
      }
    });
  });
}

// Register page Enter key
const regName = document.getElementById("name");
const regEmail = document.getElementById("email");
const regPassword = document.getElementById("password");

if (regName && regEmail && regPassword) {
  [regName, regEmail, regPassword].forEach(input => {
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        register();
      }
    });
  });
}
