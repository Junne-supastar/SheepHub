// Tabs
const tabs = document.querySelectorAll('.tab-link');
const contents = document.querySelectorAll('.tab-content');
const underline = document.querySelector('.underline');

function moveUnderline(tab) {
    underline.style.width = `${tab.offsetWidth}px`;
    underline.style.left = `${tab.offsetLeft}px`;
}

moveUnderline(document.querySelector('.tab-link.active'));

tabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.style.display = 'none');
        this.classList.add('active');
        const contentId = this.getAttribute('data-tab');
        document.getElementById(contentId).style.display = 'block';
        moveUnderline(this);
    });
});
