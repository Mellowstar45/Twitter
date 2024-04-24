function tryto() {
  let inputls = document.getElementById("searchInput").value;
  let displaySearch = document.getElementById("displaySearch");
  $.post("../../controllers/searchctrl.php", {
    input: inputls
  }, function(response) {
    displaySearch.innerHTML = response;
  });
}

