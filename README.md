mvid-php
========

This is the official MV-ID Integration library.

MVID Library
------------
The actual integration library is contained in the "mvid" folder. The file you need to include in your PHP project is
"mvid/mvid-handler.php":

    <?php
      require_once 'mvid/mvid-handler.php';
    ?>

Installation
------------
1. Copy the "mvid" folder accessable for including from your project PHP files.
2. Edit the "mvid/config/mvid-config.php" file, in particular you need to edit the "shared_key" and "domain" values

Example
-------
This is a fully working example. It requires a registered application domain and a shared-key. To try out this example:

1. Copy the index.php, start.php and error.php files to your webserver.
2. Make the site accessable via the application domain name you have registered with MV-ID.
3. Edit the "mvid-config.php" file to reflect the domain you are using.
