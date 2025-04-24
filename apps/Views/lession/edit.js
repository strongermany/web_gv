document.addEventListener('DOMContentLoaded', function() {
    // File upload handling
    const fileUpload = document.querySelector('.file-upload');
    const fileInput = document.getElementById('fileInput');

    if (fileUpload && fileInput) {
        fileUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUpload.classList.add('dragover');
        });

        fileUpload.addEventListener('dragleave', () => {
            fileUpload.classList.remove('dragover');
        });

        fileUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUpload.classList.remove('dragover');
            fileInput.files = e.dataTransfer.files;
            if (e.dataTransfer.files.length > 0) {
                updateFileName(e.dataTransfer.files[0].name);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                updateFileName(e.target.files[0].name);
            }
        });
    }

    // Modal handling
    const addButton = document.querySelector('[onclick="openModal(\'addLessonModal\')"]');
    const closeButtons = document.querySelectorAll('.close-button');
    const modals = document.querySelectorAll('.modal');

    if (addButton) {
        addButton.addEventListener('click', function(e) {
            e.preventDefault();
            openModal('addLessonModal');
        });
    }

    closeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const modalId = this.closest('.modal').id;
            closeModal(modalId);
        });
    });

    window.addEventListener('click', function(e) {
        modals.forEach(modal => {
            if (e.target === modal) {
                closeModal(modal.id);
            }
        });
    });
});

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
    }
}

function triggerFileInput() {
    document.getElementById('fileInput').click();
}

function updateFileName(fileName) {
    const fileText = document.querySelector('.file-upload p');
    if (fileText) {
        fileText.textContent = fileName;
    }
}

function updateObjectName(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const nameInput = document.getElementById('Name_object');
    if (nameInput) {
        if (selectedOption.value) {
            nameInput.value = selectedOption.dataset.name;
        } else {
            nameInput.value = '';
        }
    }
}

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const nameInput = document.querySelector('input[name="Name_ls"]');
    const classSelect = document.querySelector('select[name="Object_Id"]');
    
    if (!nameInput.value.trim()) {
        e.preventDefault();
        showError(nameInput, 'Vui lòng nhập tên bài giảng');
    }
    
    if (!classSelect.value) {
        e.preventDefault();
        showError(classSelect, 'Vui lòng chọn lớp');
    }
});

function showError(element, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    
    element.parentNode.appendChild(errorDiv);
    
    // Remove error message after 3 seconds
    setTimeout(() => {
        errorDiv.remove();
    }, 3000);
}

// Add smooth scrolling for the page
document.addEventListener('DOMContentLoaded', function() {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.animationDelay = `${index * 0.1}s`;
    });
}); 