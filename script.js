const loginBox = document.querySelector(".login-box");
const registerBox = document.querySelector(".register-box");
const registerLink = document.getElementById("register-link");
const loginLink = document.getElementById("login-link");

// Show register box on click
registerLink.addEventListener("click", function() {
	loginBox.style.display = "none";
	registerBox.style.display = "block";
});

// Show login box on click
loginLink.addEventListener("click", function() {
	loginBox.style.display = "block";
	registerBox.style.display = "none";
});


