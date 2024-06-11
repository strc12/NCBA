<?php
session_start();
if(isset($_SESSION['clubid']))
{
    session_destroy();
}

header("Location: index.php");

?>