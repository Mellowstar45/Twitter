addEventListener("DOMContentLoaded", () => {
  function loadXMLDoc() {
    let allMessages = document.getElementById("allMessages");
    $(document).ready(function(){
      $.get("../../controllers/crudChat/getChatctrl.php", function(data){
        allMessages.innerHTML = data;
      });
    });
  }

  loadXMLDoc();
  setInterval(loadXMLDoc, 2000);
});

