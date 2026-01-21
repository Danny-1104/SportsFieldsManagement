/* public/assets/js/auth.js */

// Mostrar/Ocultar Password
function togglePassword(id) {
  const input = document.getElementById(id);
  if (input) {
    input.type = input.type === "password" ? "text" : "password";
  }
}

// Validación de Password (Registro)
function validarContraseña() {
  const passInput = document.getElementById("reg-password");
  const confirmInput = document.getElementById("confirm-password");
  const btn = document.getElementById("submit-btn");

  if (!passInput || !confirmInput) return;

  const pass = passInput.value;
  const confirm = confirmInput.value;

  const checks = {
    length: pass.length >= 8,
    upper: /[A-Z]/.test(pass),
    lower: /[a-z]/.test(pass),
    number: /[0-9]/.test(pass),
    special: /[!@#$%^&*()_+\-=\[\]{};:'",.<>?\/\\|`~]/.test(pass),
  };

  actualizarIndicador("strength-length", checks.length);
  actualizarIndicador("strength-upper", checks.upper);
  actualizarIndicador("strength-lower", checks.lower);
  actualizarIndicador("strength-number", checks.number);
  actualizarIndicador("strength-special", checks.special);

  const isValid = Object.values(checks).every(Boolean);
  const isMatch = pass === confirm && pass.length > 0;

  btn.disabled = !(isValid && isMatch);
}

function actualizarIndicador(id, status) {
  const el = document.getElementById(id);
  if (!el) return;
  const icon = el.querySelector("i");

  if (status) {
    el.classList.add("completed");
    icon.className = "fas fa-check-circle";
  } else {
    el.classList.remove("completed");
    icon.className = "fas fa-circle";
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const p1 = document.getElementById("reg-password");
  const p2 = document.getElementById("confirm-password");
  if (p1) p1.addEventListener("input", validarContraseña);
  if (p2) p2.addEventListener("input", validarContraseña);
});
