<?php
session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600); // empty value and old timestamp
header('Location: ../index.php')
?>