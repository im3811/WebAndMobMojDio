document.addEventListener('DOMContentLoaded', function() {
  
  function fadeIcon(iconId) {
      var icon = document.getElementById(iconId);
      icon.style.opacity = '0';
  }


  function showIcon(iconId) {
      var icon = document.getElementById(iconId);
      icon.style.opacity = '1';
  }


  var emailInput = document.getElementById('email');
  var passwordInput = document.getElementById('password');
  var surnameInput = document.getElementById('surname');
  var userInput = document.getElementById('user'); 

  
  emailInput.addEventListener('focus', function() { fadeIcon('input-icon1'); });
  emailInput.addEventListener('blur', function() {
      if(emailInput.value === '') { showIcon('input-icon1'); }
  });


  passwordInput.addEventListener('focus', function() { fadeIcon('input-icon2'); });
  passwordInput.addEventListener('blur', function() {
      if(passwordInput.value === '') { showIcon('input-icon2'); }
  });

 
  surnameInput.addEventListener('focus', function() { fadeIcon('input-icon3'); });
  surnameInput.addEventListener('blur', function() {
      if(surnameInput.value === '') { showIcon('input-icon3'); }
  });

  
  userInput.addEventListener('focus', function() { fadeIcon('input-icon4'); });
  userInput.addEventListener('blur', function() {
      if(userInput.value === '') { showIcon('input-icon4'); }
  });
});
