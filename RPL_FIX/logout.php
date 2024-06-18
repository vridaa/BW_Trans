<?php
    session_start();
    session_destroy();

    header("location:berandaAwal.php?info=logout");
?>