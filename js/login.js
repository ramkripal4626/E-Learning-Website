// Get the login button and popup
const loginBtn = document.getElementById('login-btn');
const loginPopup = document.getElementById('login-popup');

// Add event listener to login button
loginBtn.addEventListener('click', () => {
  loginPopup.style.display = 'block';
  loginPopup.style.opacity = 0;
  setTimeout(() => {
    loginPopup.style.opacity = 1; // Changed from 5 to 1
  }, 500);
});

// Add event listener to close popup when clicked outside
document.addEventListener('click', (e) => {
  if (loginPopup.style.display === 'block' && !loginPopup.contains(e.target) && e.target !== loginBtn) {
    loginPopup.style.opacity = 0;
    setTimeout(() => {
      loginPopup.style.display = 'none';
    }, 500);
  }
});

// Get the login toggle buttons
const studentLoginBtn = document.querySelector('.student-login-btn');
const facultyLoginBtn = document.querySelector('.faculty-login-btn');

// Get the login form fields
const studentLoginFields = document.querySelector('.student-login-fields');
const facultyLoginFields = document.querySelector('.faculty-login-fields');

// Function to clear input fields


// Add event listeners to the login toggle buttons
studentLoginBtn.addEventListener('click', () => {
  studentLoginBtn.classList.add('active');
  facultyLoginBtn.classList.remove('active');
  studentLoginFields.style.display = 'block';
  facultyLoginFields.style.display = 'none';
});

facultyLoginBtn.addEventListener('click', () => {
  facultyLoginBtn.classList.add('active');
  studentLoginBtn.classList.remove('active');
  facultyLoginFields.style.display = 'block';
  studentLoginFields.style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function () {
  const studentBtn = document.querySelector('.student-login-btn');
  const facultyBtn = document.querySelector('.faculty-login-btn');
  const loginTypeInput = document.getElementById('login-type');
  
  studentBtn.addEventListener('click', function () {
    loginTypeInput.value = 'student';
    studentBtn.classList.add('active');
    facultyBtn.classList.remove('active');
    });

  facultyBtn.addEventListener('click', function () {
    loginTypeInput.value = 'faculty';
    facultyBtn.classList.add('active');
    studentBtn.classList.remove('active');
    });
});
