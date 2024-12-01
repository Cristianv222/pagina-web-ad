document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    body.style.opacity = '0';
    setTimeout(() => {
        body.style.transition = 'opacity 1s ease-in';
        body.style.opacity = '1';
    }, 100);
});
/////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.registration-form');
  
    form.addEventListener('submit', (event) => {
      event.preventDefault();
  
      const fullName = document.getElementById('fullName').value;
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const phoneNumber = document.getElementById('phoneNumber').value;
      const rememberMe = document.getElementById('rememberMe').checked;
      const subscribeToNewsletter = document.getElementById('subscribeToNewsletter').checked;
  
      // Perform form validation and submit logic here
      console.log('Form data:', {
        fullName,
        email,
        password,
        confirmPassword,
        phoneNumber,
        rememberMe,
        subscribeToNewsletter
      });
    });
  });