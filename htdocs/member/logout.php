<?php
session_start();

setcookie('autologin', '', time()-3600, "/");


session_destroy();


echo '<meta http-equiv="refresh"; content="0; url=/index.php">';
?>