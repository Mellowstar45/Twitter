addEventListener("DOMContentLoaded", () => {
  function loadXMLDoc() {
    let allChats = document.getElementById("allChats");
    $(document).ready(function(){
      $.get("../../controllers/chatListctrl.php", function(data){
        allChats.innerHTML = data;
      });
    });
  }
  loadXMLDoc();
  setInterval(loadXMLDoc, 15000);
});
