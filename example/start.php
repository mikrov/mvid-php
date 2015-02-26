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
	
	require_once("mvid/mvid-handler.php");
	$mv_session_id = $$mvid_storage_name;
	
?>

<html>

  <head>
    <title>MV-ID Unauthenticated</title>
    <meta charset="utf-8" />
    <script src="<?php echo $mvid_url; ?>/sp-js/mvlogin.js" type="text/javascript"></script>
    <script type="text/javascript">
  
	  mvid_url = '<?php echo $mvid_url; ?>';
		
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
