<?php
session_start();

session_unset();
session_destroy();

echo "<script>alert('Silahkan Login');
        document.location.href= 'login.php';; 
        </script> ";
