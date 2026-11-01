<?php

require_once(__DIR__ . '/sessions.php');

if(isset($_SESSION['clubid']))
{
    session_destroy();
}

header("Location: index.php");

?>