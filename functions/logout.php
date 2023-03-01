<?php
session_start();
session_unset();
session_destroy();

echo "vous êtes deconnecté(e)s avec succés  ";
header('REFRESH:1;URL=../home.php');
?>