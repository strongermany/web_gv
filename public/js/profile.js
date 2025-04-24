document.addEventListener('DOMContentLoaded', function() {
    const profileForm = document.getElementById('profileForm');
    const passwordForm = document.getElementById('passwordForm');
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const changeAvatarBtn = document.getElementById('changeAvatarBtn');
    const tabButtons = document.querySelectorAll('.tab-btn');
    const profileHeader = document.querySelector('.profile-header');
    const profileAvatar = document.querySelector('.profile-avatar');

    // Tab Switching
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');

            // Show/hide profile header and avatar based on active tab
            if (tabId === 'classes') {
                profileHeader.style.display = 'none';
                profileAvatar.style.display = 'none';
            } else {
                profileHeader.style.display = 'flex';
                profileAvatar.style.display = 'block';
            }
        });
    });

    // Avatar Change
    if (changeAvatarBtn && avatarInput) {
        changeAvatarBtn.addEventListener('click', () => {
            avatarInput.click();
        });

        avatarInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Profile Update
    if (profileForm) {
        profileForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification('Profile updated successfully', 'success');
                    // Update displayed info if needed
                    updateDisplayedInfo(formData);
                } else {
                    showNotification(result.message || 'Update failed', 'error');
                }
            } catch (error) {
                showNotification('An error occurred', 'error');
                console.error('Error:', error);
            }
        });
    }

    // Password Change
    if (passwordForm) {
        passwordForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const newPass = this.querySelector('[name="new_password"]').value;
            const confirmPass = this.querySelector('[name="confirm_password"]').value;
            
            if (newPass !== confirmPass) {
                showNotification('Passwords do not match', 'error');
                return;
            }
            
            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification('Password changed successfully', 'success');
                    this.reset();
                } else {
                    showNotification(result.message || 'Password change failed', 'error');
                }
            } catch (error) {
                showNotification('An error occurred', 'error');
                console.error('Error:', error);
            }
        });
    }

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredInputs = form.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
            }
        });
    });

    // Check for success/error messages in URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');
    const errorMessage = urlParams.get('error');

    if (successMessage) {
        showNotification(successMessage, 'success');
    }

    if (errorMessage) {
        showNotification(errorMessage, 'error');
    }
});

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Trigger animation
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

function updateDisplayedInfo(formData) {
    // Update displayed name
    const nameDisplay = document.querySelector('.profile-info h1');
    if (nameDisplay && formData.get('Admin_name')) {
        nameDisplay.textContent = formData.get('Admin_name');
    }
    
    // Update email
    const emailDisplay = document.querySelector('.contact-info .email');
    if (emailDisplay && formData.get('Email')) {
        emailDisplay.textContent = formData.get('Email');
    }
    
    // Update phone
    const phoneDisplay = document.querySelector('.contact-info .phone');
    if (phoneDisplay && formData.get('Phone')) {
        phoneDisplay.textContent = formData.get('Phone');
    }
    
    // Update status badge
    const statusBadge = document.querySelector('.status-badge');
    if (statusBadge && formData.get('Status')) {
        const isActive = formData.get('Status') === '1';
        statusBadge.className = `status-badge ${isActive ? 'active' : 'inactive'}`;
        statusBadge.innerHTML = `<i class="fas fa-${isActive ? 'check-circle' : 'times-circle'}"></i> ${isActive ? 'Active' : 'Inactive'}`;
    }
} 