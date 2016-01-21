<?php

    /**
	 * Note about using dev/test environments
	 * MV-ID can be set to use the production environment or a test or development environment. If you are using another environment than production,
	 * you should specify a context that determines what dev or test instance to run on.
	 * The environment and context is read from the mvid-config.php file, but can also be specified here as:
	 * $mvidEnv = "dev";
	 * $mvidContext = "mvid-v31";
	 * These needs to be set before including the mvid-handler.php
	 * After including mvid-handler.php you also have the variable $mvid_url that defines the url of the mvid instance you are using
	 */

	//$mvidEnv = "dev";
	//$mvidContext = "mvid-v31";

	require_once __DIR__."/../mvid/mvid-handler.php";
	$mv_session_id = $$mvid_storage_name;

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>MV-ID Unauthenticated</title>
    <script src="<?=$mvid_url;?>/sp-js/mvlogin.js"></script>
    <script type="text/javascript">

	  var mvid_url = '<?=$mvid_url;?>';

      $(function() {
        doKeepAlive({
            mv_session_id: "<?=$mv_session_id;?>",
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
    Logged in with mv_session_id: <?=$mv_session_id;?>
  </body>

</html>
