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

      mvid_url = '<?=$mvid_url;?>';

      $(function() {
        var sso_args = {
          mv_session_id: "<?=$mv_session_id;?>"
        }
        doSSO(sso_args,function(res) {
          if (res.app_auth_ok) {
            /* SSO Success:
               User has been authenticated and the application has been registered for session usage
               In this example the user is redirected to the location entered in mvid-config.php.
               If you are already in the "redirect_on_success" page */
            document.location = 'start.php';
          }
          else if (!res.mvid_auth_ok) {
            /* SSO Failed:
               User has not been authenticated or the application did not register the session
               correctly. In this example we will place a login button for the user to press.
               Alternatively you can just want to call doLogin() right away as shown in the code comment*/
            $("#mvid").html("<button onclick='doLogin()'>Login</button>");
            //doLogin();
          }
        });
      });

    </script>
  </head>

  <body>
    <div id="mvid"></div>
  </body>

</html>
