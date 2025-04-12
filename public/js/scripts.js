// filepath: web_gv/web_gv/public/js/scripts.js
document.addEventListener('DOMContentLoaded', function() {
    // Function to validate login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            if (username === '' || password === '') {
                event.preventDefault();
                alert('Please fill in both fields.');
            }
        });
    }

    // Function to handle document uploads
    const uploadForm = document.getElementById('uploadForm');
    if (uploadForm) {
        uploadForm.addEventListener('submit', function(event) {
            const fileInput = document.getElementById('fileInput');
            if (fileInput.files.length === 0) {
                event.preventDefault();
                alert('Please select a file to upload.');
            }
        });
    }

    // Function to handle grade entry
    const gradeForm = document.getElementById('gradeForm');
    if (gradeForm) {
        gradeForm.addEventListener('submit', function(event) {
            const gradeInputs = document.querySelectorAll('.gradeInput');
            let valid = true;
            gradeInputs.forEach(input => {
                if (input.value === '' || isNaN(input.value)) {
                    valid = false;
                }
            });
            if (!valid) {
                event.preventDefault();
                alert('Please enter valid grades for all students.');
            }
        });
    }

    // Function to handle attendance
    const attendanceForm = document.getElementById('attendanceForm');
    if (attendanceForm) {
        attendanceForm.addEventListener('submit', function(event) {
            const attendanceInputs = document.querySelectorAll('.attendanceInput');
            let valid = true;
            attendanceInputs.forEach(input => {
                if (!input.checked) {
                    valid = false;
                }
            });
            if (!valid) {
                event.preventDefault();
                alert('Please mark attendance for all students.');
            }
        });
    }
});