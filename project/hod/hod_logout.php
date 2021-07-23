<?php
session_start();
session_unset();
session_destroy();
header('location:hod_index.php?err='.urlencode('logged out successfully'));
?>
