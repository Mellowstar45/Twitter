  function createChat(id){
    $(document).ready(function() {
      let signe = prompt("Choose a name for the chat ?");
      $.post("../../controllers/crudChat/createChatctrl.php",
        {
          id_chat_user: id,
          convo_name: signe
        },
      );
    })
  }
