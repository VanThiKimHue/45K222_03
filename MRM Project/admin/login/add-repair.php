<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
// Code thêm quản lý sửa chữa mới
if(isset($_POST['submit']))
{
$tenxe=$_POST['xethue'];
$ghichu=$_POST['ghichu'];
$phi=$_POST['phi'];
$sql="INSERT into suachua (idxe, GhiChu, SoTien) value(:xethue,:ghichu,:phi)";
$query = $dbh->prepare($sql);
$query->bindParam(':xethue',$tenxe,PDO::PARAM_STR);
$query->bindParam(':ghichu',$ghichu,PDO::PARAM_STR);
$query->bindParam(':phi',$phi,PDO::PARAM_STR);

$query->execute();

$msg=" Đăng bản quản lý sửa chữa thành công";


}
if(isset($_POST['back']))
{
	header("Location: manage-repair.php");
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

	<title>Motorbike Rental Management | Admin Create Brand</title>

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

						<h2 class="page-title">Thêm Mới Thông Tin Sửa Chữa</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"></div>
									<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>Thành công</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">

<form method="post" class="form-horizontal" enctype="multipart/form-data" name="submit" onSubmit="return valid();">
<div class="form-group">
<label class="col-sm-2 control-label">Biển Số Xe<span style="color:red">*</span></label>
  <div class="col-sm-3">
  <select class="form-control" name="xethue" id="xethue" required>
	<option value=""> Lựa chọn </option>
	<?php $ret="select id,TenXe from thongtinxe";
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
 <label class="col-sm-2 control-label">Ghi Chú<span style="color:red">*</span></label>
 <div class="col-sm-3">
 <input type="text" class="form-control" name="ghichu" value="" required>
</div>
</div>
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Số Tiền<span style="color:red">*</span></label>
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
													
													<button class="btn btn-default" type="back" name="back" style="font-size:medium">Quay lại</button>
													<button class="btn btn-primary" name="submit" type="submit" id="submit"style="font-size: medium;">Thêm mới</button>
												</div>
											</div>
</form>


									</div>
								</div>
							</div>

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
		$("#xethue").chosen();
    </script>
</body>

</html>
<?php } ?>
