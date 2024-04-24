document.addEventListener("DOMContentLoaded", function () {
  let startModify = document.getElementById("showForm");
  let endModify = document.getElementById("endModify");
  let modifyForm = document.getElementById("modifyForm");
  let accountPage = document.getElementById("accountpage");
  let back = document.getElementById('return');
  let rBar = document.getElementById('rightBarHide')

  startModify.addEventListener("click", function (hideAccount) {
    modifyForm.style.display = "block";
    accountPage.style.display = "none";
  });

  endModify.addEventListener("click", function (hideModifyForm) {
    accountPage.style.display = "block";
    modifyForm.style.display = "none";
  });

  back.addEventListener("click", function (backAccount){
    accountPage.style.display = "block";
    modifyForm.style.display = "none";
  })
});
