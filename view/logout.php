<?php
  
    session_start();
    session_destroy();
    header('Location: loginView.html');
    exit;

    
?>