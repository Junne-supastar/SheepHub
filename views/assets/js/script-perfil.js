function previewImage(input, containerSelector) {
  const container = document.querySelector(containerSelector);
  const file = input.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = () => {
    container.style.backgroundImage = `url(${reader.result})`;
    container.classList.add('has-image');
  };
  reader.readAsDataURL(file);
}

// Banner
document.getElementById('arquivo-banner')
        .addEventListener('change', function() {
  previewImage(this, '.capa');
});

// Avatar
document.getElementById('arquivo-avatar')
        .addEventListener('change', function() {
  previewImage(this, '.avatar');
});

