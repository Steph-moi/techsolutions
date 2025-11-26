<?php
session_start();
session_destroy();
header('Location: /techsolutions/index.php');
exit();
?>