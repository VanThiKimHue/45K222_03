<?php
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "Lỗi : Email không hợp lệ.";
	}

}
if(!empty($_POST["brand"])) {
	$brand= $_POST["brand"];
	$sql ="SELECT TenHang FROM hangxe WHERE TenHang=:brand";
$query= $dbh -> prepare($sql);
$query-> bindParam(':brand', $brand, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Hãng xe đã tồn tại .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{

	echo "<span style='color:green'> Hãng xe hợp lệ .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}

}
if(!empty($_POST["tenxe"])) {
	$tenxe= $_POST["tenxe"];
	$sql ="SELECT TenXe FROM thongtinxe WHERE TenXe=:tenxe";
$query= $dbh -> prepare($sql);
$query-> bindParam(':tenxe', $tenxe, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Xe đã tồn tại .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{

	echo "<span style='color:green'> Xe hợp lệ .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}

}
if(!empty($_POST["xethue"])) {
	$xethue= $_POST["xethue"];
	$sql ="SELECT id,GiaThueTheoNgay FROM thongtinxe WHERE id=:xethue";
$query= $dbh -> prepare($sql);
$query-> bindParam(':xethue', $xethue, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
	foreach($results as $result)
	{
		echo ($result->GiaThueTheoNgay);
	}

}
}

?>
