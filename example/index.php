<?php
  require_once("mvid-challenge.php");

  $shared_key = "<shared-key>";     // Shared key beween application and MV-ID
  $domain = "<application-domain>"; // The application domain registed at MV-ID

  $mv_session_hash = $_POST["mv_session_hash"];
  if (isset($_COOKIE["mv_session_id"])) {
    $mv_session_id = $_COOKIE["mv_session_id"];
  }
  else if ($mv_session_hash) {
    // A session hash was recieved from MV-ID
    $success = registerSessionUsage($mv_session_hash,$domain,$shared_key,$mv_session_id,$error_message);
    if ($success) {
      setcookie("mv_session_id",$mv_session_id);
    }
    else {
      echo("Error: ".$error_message);
    }
  }
?>
 
<html>
 
  <head>
    <title>MV-ID Unauthenticated</title>
    <meta charset="utf-8" />
    <script src="https://signon.mv-nordic.com/sp-js/mvlogin.js" type="text/javascript"></script>
  </head>
 
  <body>
<?
  if (isset($mv_session_id)) {
    echo("Logged in with mv_session_id : $mv_session_id");
  }
  else {
    echo("<button onclick='doLogin()'>Login</button>");
  }
?>
  </body>
 
</html>

