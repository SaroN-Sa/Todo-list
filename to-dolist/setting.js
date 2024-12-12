document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('#toggle-theme');
    const themeForm = document.querySelector('#theme-form');
    const themeInput = document.querySelector('#theme-input');

    // Load saved theme preference from localStorage
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    toggleButton.addEventListener('click', () => {
        // Toggle between light and dark modes
        if (document.body.classList.contains('light-mode')) {
            document.body.classList.remove('light-mode');
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark-mode');
            themeInput.value = 'dark-mode'; // Set the theme to dark-mode
        } else {
            document.body.classList.remove('dark-mode');
            document.body.classList.add('light-mode');
            localStorage.setItem('theme', 'light-mode');
            themeInput.value = 'light-mode'; // Set the theme to light-mode
        }

        // Submit the form to apply the theme and redirect
        themeForm.submit();
    });
});
