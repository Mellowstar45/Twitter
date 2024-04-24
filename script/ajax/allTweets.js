addEventListener("DOMContentLoaded", () => {
  function loadXMLDoc() {
    let allTweets = document.getElementById("allTweets");
    $(document).ready(function(){
      $.get("../../controllers/tweetctrl.php", function(data){
        allTweets.innerHTML = data;
      });
    });
  }
  loadXMLDoc();
  setInterval(loadXMLDoc, 5000);
});
