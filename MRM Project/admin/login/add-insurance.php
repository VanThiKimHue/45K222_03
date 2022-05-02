<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
// Code thêm quản lý bảo dưỡng mới
if(isset($_POST['submit']))
{
$tenxe=$_POST['tenxe'];
$ngaymua=$_POST['ngaymua'];
$ngayhet=$_POST['ngayhet'];
$phi=$_POST['phi'];
$sql="INSERT INTO  baohiem(idxe,NgayMua,NgayHet,SoTien) VALUES(:tenxe,:ngaymua,:ngayhet,:phi)";
$query = $dbh->prepare($sql);
$query->bindParam(':tenxe',$tenxe,PDO::PARAM_STR);
$query->bindParam(':ngaymua',$ngaymua,PDO::PARAM_STR);
$query->bindParam(':ngayhet',$ngayhet,PDO::PARAM_STR);
$query->bindParam(':phi',$phi,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg=" Tạo bản quản lý bảo hiểm mới thành công";
}
else
{
$error=" Đã xảy ra lỗi. Vui lòng thử lại";
}

}
if(isset($_POST['back']))
{
	header("Location: manage-maintenance.php");
exit;
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<link rel="shortcut icon" type="image/jpg" href="img/Snapseed.jpg"/>
	<title>Motorbike Rental Management | Admin </title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.chosen-container {
font-size:18px;
}

.chosen-container-single .chosen-single {
    height: 40px;
    padding: 7px 0 0 8px;
}
.chosen-container-single .chosen-single div{
top:7px;
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Thêm Thông Tin Bảo Hiểm Mới</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"></div>
									<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">

<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
 <label class="col-sm-2 control-label">Tên Xe<span style="color:red">*</span></label>
 <div class="col-sm-2">
  	<select class="form-control" name="tenxe" id="tenxe" required>
	<option value=""> Lựa chọn </option>
	<?php 
	$ret="select id,TenXe from thongtinxe";
	$query= $dbh -> prepare($ret);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
	foreach($results as $result)
	{
	?>
	<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TenXe);?></option>
	<?php }} ?>

    </select>
 </div>
</div>


<div class="form-group">
 <label class="col-sm-2 control-label">Ngày mua<span style="color:red">*</span></label>
 <div class="col-sm-2">
 <input  class="fromdate form-control" name="ngaymua"  value="" required>
</div>

 <label class="col-sm-2 control-label">Ngày hết hạn<span style="color:red">*</span></label>
 <div class="col-sm-2">
 <input  class="todate form-control" name="ngayhet" value="" required>
</div>
</div>
<script type="text/javascript">
	        $('.fromdate').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
$('.todate').datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
});
</script>
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Số tiền đã trả<span style="color:red">*</span></label>
<div class="col-sm-2">
<input class="form-control" name="phi" value="" required>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>
</div>







											<div class="form-group" >
												<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													
													<button class="btn btn-default" type="reset" style="font-size:medium">Hủy</button>
													<button class="btn btn-primary" name="submit" type="submit" id="submit"style="font-size: medium;">Thêm mới</button>
												</div>
											</div>
</form>


									</div>
								</div>
							</div>

						</div>

						<div class="col-sm-8 col-sm-offset-2" align="center" style="margin-left:13%;margin-right:auto;display:block;margin-top:0%;margin-bottom:auto;">
													<a href="manage-insurance.php" class="btn btn-default" name="back" type="button" id="back"style="font-size: medium; background-color: grey;">Quay lại</a>
												</div>

					</div>
				</div>


			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<!-- <script src="js/jquery.min.js"></script> -->
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script src="js/jautocalc.js"></script>
	<script src="js/script.js"></script>
	<script>
		$("#tenxe").chosen();
    </script>
</body>

</html>
<?php } ?>
