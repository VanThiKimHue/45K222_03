<?php
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "Lỗi : Email không hợp lệ.";
	}

}


?>
