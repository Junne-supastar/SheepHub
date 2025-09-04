document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');

  form.addEventListener('submit', function (e) {
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value.trim();

    // Opcional: exibir os dados para debug
    console.log('Login submitted:', { email, senha });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const toast = document.getElementById("toast");
  const message = toast?.dataset.msg;

  function showToast(message, duration = 4000) {
    if (!toast || !message) return;
    toast.textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), duration);
  }

  if (message) {
    showToast(message);
  }
});





  