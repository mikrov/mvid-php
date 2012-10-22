<?php
  require_once("mvid/mvid-handler.php");
  $mv_session_id = $$mvid_storage_name;
?>

<html>

  <head>
    <title>MV-ID Unauthenticated</title>
    <meta charset="utf-8" />
    <script src="https://signon.mv-nordic.com/sp-js/mvlogin.js" type="text/javascript"></script>
    <script type="text/javascript">
  
      $(function() {
        doKeepAlive({
            mv_session_id: "<?=$mv_session_id?>",
            on_session_lost: "index.php"
          },
          function(is_session_alive) {
            // Manually handle lost session by testing on is_session_alive
            // on_session_lost argument used above should be all yuo need
            // in most cases.
          }
        );
      });
    
    </script>
  </head>

  <body>
    Logged in with mv_session_id: <?=$mv_session_id?>
  </body>

</html>
