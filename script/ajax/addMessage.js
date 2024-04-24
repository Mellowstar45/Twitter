function addMessage() {
  let input = document.getElementById("inputMessage").value;
  $(document).ready(function() {
    $.post("../../controllers/crudChat/addMessagectrl.php",
      {
        name: input
      },
    );
  })
}
