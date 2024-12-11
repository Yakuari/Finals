// Toggle dropdown menu on click
const settingsBtn = document.getElementById('settings-btn');
const settingsContent = document.getElementById('settings-content');

settingsBtn.addEventListener('click', function(event) {
    event.preventDefault();
    settingsContent.classList.toggle('show');
});

// Close dropdown if clicked outside
window.onclick = function(event) {
    if (!event.target.matches('.settings-btn')) {
        if (settingsContent.classList.contains('show')) {
            settingsContent.classList.remove('show');
        }
    }
};