<?php
  require_once("mvid-challenge.php");
  require_once("config/mvid-config.php");

  $mvid_app_domain = read_config(Array("mvid","challenge","domain"));
  $mvid_shared_key = read_config(Array("mvid","challenge","shared_key"));
  $mvid_redirect_on_success = read_config(Array("mvid","challenge","redirect_on_success"));
  $mvid_redirect_on_failure = read_config(Array("mvid","challenge","redirect_on_failure"));
  $mvid_storage_type = read_config(Array("mvid","storage","type"),"cookie");
  $mvid_storage_name = read_config(Array("mvid","storage","name"),"mv_session_id");

  $storage_class = NULL;
  
  if(@include("sessionstorage/$mvid_storage_type.php")) {
    $storage_class = $mvid_storage_type."SessionStorage";
    $storage_class = new $storage_class;
  }
  if ($storage_class===NULL) {
    $error_message = "The storage type: $mvid_storage_type is not available.";
  }

  if (isset($_POST["mv_session_hash"])) {
  
    // A session hash was recieved from MV-ID either after a doLogin() or a doSSO()
    $success = false;
    if ($storage_class!==NULL) {
      // Register the session hash for application usage:
      $success = registerSessionUsage($_POST["mv_session_hash"],$mvid_app_domain,$mvid_shared_key,$$mvid_storage_name,$error_message);
    }
    
    if ($success) {
      $storage_class->save($mvid_storage_name,$$mvid_storage_name);

      if ($mvid_redirect_on_success !== NULL) {
        header( "Location: $mvid_redirect_on_success" ) ;
      }
    }
    else {
      if ($mvid_redirect_on_failure !== NULL) {
        header( "Location: $mvid_redirect_on_failure?error_message=".urlencode($error_message) ) ;
      }
      else {
        echo("Error: ".$error_message);
        exit(0);
      }
    }
  }
  else {
    if ($storage_class===NULL) {
      echo("Error: ".$error_message);
      exit(0);
    }
    else {
      $$mvid_storage_name = $storage_class->load($mvid_storage_name);
    }
  }

?>
