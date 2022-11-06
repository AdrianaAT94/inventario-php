<?php 
  session_start();
  if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
  }
  else {
  	if (isset($_SESSION['inst_login_status']) AND $_SESSION['inst_login_status'] == 1) {
  	}
  	else {
        header("location: ../login.php");
    	exit;
  	}
  } 