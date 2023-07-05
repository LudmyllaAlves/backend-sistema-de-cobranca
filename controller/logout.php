<?php
session_start();
session_destroy();
unset($_SESSION['nome']);
unset($_SESSION['senha']);
header("location:http://localhost:8080/");
?>