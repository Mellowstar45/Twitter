document.addEventListener("DOMContentLoaded", function () {
  let formlogin = document.getElementById("formlogin");
  let formsignup = document.getElementById("formsignup");
  let signup = document.getElementById("signup");
  let login = document.getElementById("login");
  let back = document.getElementById('return');

  signup.addEventListener("click", function (event) {
    formsignup.style.display = "block";
    formlogin.style.display = "none";
  });

  login.addEventListener("click", function (ev) {
    formlogin.style.display = "block";
    formsignup.style.display = "none";
  });
});
