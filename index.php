<?php
include 'classes-dao.php';

Dao::create_db();

//STATIC USER CREDENTIALS:
// email: user1@mail.com
// password: 1234

header("Location: login.php");
?>